<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with(['employee.department'])->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 'active')->get();
        return view('attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        $data = $request->validated();

        // Prevent duplicate attendance for same employee same day
        $exists = Attendance::where('employee_id', $data['employee_id'])
            ->whereDate('date', $data['date'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['employee_id' => 'Attendance already exists for this employee on this date.']);
        }

        $attendance = new Attendance($data);
        $attendance->save(); // calculateStatus should be called if using observer or manually

        // Manually calculate status if not in observer
        $attendance->status = $attendance->calculateStatus();
        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());

        // Recalculate status
        $attendance->status = $attendance->calculateStatus();
        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    /**
     * Show the check-in form for employees
     */
    public function showCheckIn()
    {
        $employees = Employee::where('status', 'active')->get();
        return view('attendances.check-in', compact('employees'));
    }

    /**
     * Process employee check-in
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::today();
        $now = Carbon::now();

        // Check if employee already checked in today
        $exists = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', $today)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Vous avez déjà pointé aujourd\'hui.');
        }

        // Calculate status based on check-in time
        $workStart = Carbon::createFromTime(Attendance::WORK_START_HOUR, 0, 0);
        $checkInTime = $now->format('H:i:s');
        $lateMinutes = 0;
        $status = 'present';

        if ($now->greaterThan($workStart->addMinutes(Attendance::GRACE_PERIOD_MINUTES))) {
            $lateMinutes = $now->diffInMinutes($workStart->subMinutes(Attendance::GRACE_PERIOD_MINUTES));
            $status = 'late';
        }

        // Create attendance record
        $attendance = Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => $today,
            'check_in' => $now,
            'status' => $status,
            'late_minutes' => $lateMinutes,
        ]);

        $employee = Employee::find($request->employee_id);

        return redirect()->route('dashboard')->with('success', 'Présence confirmée pour ' . $employee->full_name . ' à ' . $now->format('H:i'));
    }

    /**
     * Show the check-out form for employees
     */
    public function showCheckOut()
    {
        $today = Carbon::today();

        // Only show employees who have checked in today but haven't checked out yet
        $employeeIds = Attendance::whereDate('date', $today)
            ->whereNull('check_out')
            ->pluck('employee_id');

        $employees = Employee::whereIn('id', $employeeIds)
            ->where('status', 'active')
            ->get();

        return view('attendances.check-out', compact('employees'));
    }

    /**
     * Process employee check-out
     */
    public function checkOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::today();
        $now = Carbon::now();

        // Find today's attendance record
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', 'Aucun pointage d\'arrivée trouvé pour aujourd\'hui. Veuillez d\'abord pointer votre arrivée.');
        }

        if ($attendance->check_out) {
            return redirect()->back()->with('error', 'Vous avez déjà pointé votre départ aujourd\'hui.');
        }

        // Update attendance with check-out time
        $attendance->update([
            'check_out' => $now,
        ]);

        $employee = Employee::find($request->employee_id);

        return redirect()->route('dashboard')->with('success', 'Départ confirmé pour ' . $employee->full_name . ' à ' . $now->format('H:i'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
