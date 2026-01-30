<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    // Work hours configuration
    const WORK_START_HOUR = 8;  // 8h
    const WORK_END_HOUR = 17;   // 17h
    const GRACE_PERIOD_MINUTES = 15;  // 15 minutes grace period for late arrivals

    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'late_minutes',
        'early_departure_minutes',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculateStatus()
    {
        $schedule = $this->employee->department->workSchedule;

        if (!$this->check_in) {
            return 'absent';
        }

        $checkInTime = Carbon::parse($this->check_in);
        $scheduleStart = Carbon::parse($schedule->start_time);
        $gracePeriod = $schedule->grace_period_minutes;

        if ($checkInTime->greaterThan($scheduleStart->addMinutes($gracePeriod))) {
            $this->late_minutes = $checkInTime->diffInMinutes($scheduleStart);
            return 'late';
        }

        if ($this->check_out) {
            $checkOutTime = Carbon::parse($this->check_out);
            $scheduleEnd = Carbon::parse($schedule->end_time);

            if ($checkOutTime->lessThan($scheduleEnd)) {
                $this->early_departure_minutes = $scheduleEnd->diffInMinutes($checkOutTime);
                return 'early_departure';
            }
        }

        return 'present';
    }
}
