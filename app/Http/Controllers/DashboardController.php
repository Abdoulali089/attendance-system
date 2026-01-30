<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Build query for today's attendances
        $todayQuery = Attendance::whereDate('date', $today);

        // Calculate stats
        $stats = [
            'present' => (clone $todayQuery)->where('status', 'present')->count(),
            'late' => (clone $todayQuery)->where('status', 'late')->count(),
            'absent' => (clone $todayQuery)->where('status', 'absent')->count(),
            'early_departure' => (clone $todayQuery)->where('status', 'early_departure')->count(),
        ];

        // Get recent attendances
        $recentAttendances = Attendance::with(['employee.department'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentAttendances'));
    }
}
