<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function daily(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());
        $carbonDate = Carbon::parse($date);

        $attendances = Attendance::with(['employee.department'])
            ->whereDate('date', $carbonDate)
            ->get();

        $stats = [
            'present' => $attendances->where('status', 'present')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'early_departure' => $attendances->where('status', 'early_departure')->count(),
        ];

        return view('reports.daily', compact('attendances', 'stats', 'date'));
    }

    public function monthly(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $carbonMonth = Carbon::parse($month . '-01');

        $attendances = Attendance::with(['employee.department'])
            ->whereYear('date', $carbonMonth->year)
            ->whereMonth('date', $carbonMonth->month)
            ->get();

        $employees = Employee::with('department')->get();

        $reportData = $employees->map(function ($employee) use ($attendances) {
            $employeeAttendances = $attendances->where('employee_id', $employee->id);
            return [
                'employee' => $employee,
                'present' => $employeeAttendances->where('status', 'present')->count(),
                'late' => $employeeAttendances->where('status', 'late')->count(),
                'absent' => $employeeAttendances->where('status', 'absent')->count(),
                'early' => $employeeAttendances->where('status', 'early_departure')->count(),
                'total' => $employeeAttendances->count(),
            ];
        });

        return view('reports.monthly', compact('reportData', 'month'));
    }

    public function employee(Request $request)
    {
        $employeeId = $request->get('employee_id');
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $carbonMonth = Carbon::parse($month . '-01');

        $employees = Employee::orderBy('last_name')->get();
        $selectedEmployee = $employeeId ? Employee::find($employeeId) : null;

        $attendances = [];
        if ($selectedEmployee) {
            $attendances = Attendance::where('employee_id', $selectedEmployee->id)
                ->whereYear('date', $carbonMonth->year)
                ->whereMonth('date', $carbonMonth->month)
                ->orderBy('date', 'desc')
                ->get();
        }

        return view('reports.employee', compact('employees', 'selectedEmployee', 'attendances', 'month', 'employeeId'));
    }

    public function exportDaily(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());
        $attendances = Attendance::with(['employee.department'])
            ->whereDate('date', $date)
            ->get();

        $fileName = "rapport_journalier_{$date}.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Employé', 'Département', 'Arrivée', 'Sortie', 'Statut']);

            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->employee->full_name,
                    $attendance->employee->department->name,
                    $attendance->check_in ? $attendance->check_in->format('H:i') : '--:--',
                    $attendance->check_out ? $attendance->check_out->format('H:i') : '--:--',
                    $attendance->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportMonthly(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $carbonMonth = Carbon::parse($month . '-01');

        $attendances = Attendance::with(['employee.department'])
            ->whereYear('date', $carbonMonth->year)
            ->whereMonth('date', $carbonMonth->month)
            ->get();

        $employees = Employee::with('department')->get();

        $fileName = "rapport_mensuel_{$month}.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($employees, $attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Employé', 'Département', 'Présents', 'Retards', 'Sorties Anticipées', 'Absents', 'Total']);

            foreach ($employees as $employee) {
                $eAtt = $attendances->where('employee_id', $employee->id);
                fputcsv($file, [
                    $employee->full_name,
                    $employee->department->name,
                    $eAtt->where('status', 'present')->count(),
                    $eAtt->where('status', 'late')->count(),
                    $eAtt->where('status', 'early_departure')->count(),
                    $eAtt->where('status', 'absent')->count(),
                    $eAtt->count()
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportEmployee(Request $request)
    {
        $employeeId = $request->get('employee_id');
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $carbonMonth = Carbon::parse($month . '-01');

        $employee = Employee::findOrFail($employeeId);
        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereYear('date', $carbonMonth->year)
            ->whereMonth('date', $carbonMonth->month)
            ->orderBy('date', 'desc')
            ->get();

        $fileName = "rapport_{$employee->last_name}_{$month}.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($attendances, $employee) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Employé', 'Arrivée', 'Sortie', 'Statut', 'Notes']);

            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->date->format('Y-m-d'),
                    $employee->full_name,
                    $attendance->check_in ? $attendance->check_in->format('H:i') : '--:--',
                    $attendance->check_out ? $attendance->check_out->format('H:i') : '--:--',
                    $attendance->status,
                    $attendance->notes
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
