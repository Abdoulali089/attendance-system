@extends('layouts.app')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Bonjour, {{ auth()->user()->name }} 👋
                </h1>
                <p class="mt-1 text-slate-500 font-medium">Voici l'aperçu de l'activité d'aujourd'hui, le
                    {{ now()->translatedFormat('d F Y') }}.
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <span
                    class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white border border-slate-200 text-slate-700 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    Système En Ligne
                </span>
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Present Card -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div
                    class="absolute -bottom-4 -right-4 opacity-[0.05] group-hover:scale-125 transition-transform duration-700 text-emerald-600 pointer-events-none">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-emerald-100 text-emerald-600 p-3 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div
                            class="flex items-center text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">
                            +12%
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Présents</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $stats['present'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <!-- Late Card -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div
                    class="absolute -bottom-4 -right-4 opacity-[0.05] group-hover:scale-125 transition-transform duration-700 text-amber-600 pointer-events-none">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-amber-100 text-amber-600 p-3 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">
                            ⚠️
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Retards</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $stats['late'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <!-- Absent Card -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div
                    class="absolute -bottom-4 -right-4 opacity-[0.05] group-hover:scale-125 transition-transform duration-700 text-rose-600 pointer-events-none">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-rose-100 text-rose-600 p-3 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="flex items-center text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-lg">
                            -5%
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Absents</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $stats['absent'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <!-- Early Card -->
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div
                    class="absolute -bottom-4 -right-4 opacity-[0.05] group-hover:scale-125 transition-transform duration-700 text-indigo-600 pointer-events-none">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.293 12.293a1 1 0 101.414 1.414l2-2A1 1 0 0011 10.586V7z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div class="flex items-center text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">
                            Stable
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Anticipés</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $stats['early_departure'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Recent Activity Table -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900">Activités Récentes</h2>
                        <a href="{{ route('attendances.index') }}"
                            class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">Voir tout</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th
                                        class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        Employé</th>
                                    <th
                                        class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        Heures</th>
                                    <th
                                        class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse($recentAttendances as $attendance)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center shadow-sm">
                                                        <span class="text-white font-bold text-xs">
                                                            {{ substr($attendance->employee->first_name, 0, 1) }}{{ substr($attendance->employee->last_name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-slate-900">
                                                        {{ $attendance->employee->full_name }}
                                                    </div>
                                                    <div class="text-xs font-medium text-slate-500">
                                                        {{ $attendance->employee->department->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <div class="text-sm font-bold text-slate-900 flex items-center">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 mr-2"></span>
                                                    {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '--:--' }}
                                                </div>
                                                <div class="text-xs font-medium text-slate-400 flex items-center mt-1">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-200 mr-2"></span>
                                                    {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '--:--' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4 whitespace-nowrap">
                                            @if($attendance->status === 'present')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                    Présent
                                                </span>
                                            @elseif($attendance->status === 'late')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                                    Retard ({{ $attendance->late_minutes }}m)
                                                </span>
                                            @elseif($attendance->status === 'early_departure')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-100">
                                                    Parti tôt
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                                    Absent
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-8 py-10 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="p-4 bg-slate-50 rounded-full mb-3 text-slate-400 text-2xl">📭</div>
                                                <p class="text-slate-500 font-bold">Aucune activité pour le moment</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right: Rapid Actions & Shortcuts -->
            <div class="space-y-6">
                <!-- Rapid Actions -->
                <div
                    class="bg-indigo-700 rounded-3xl p-8 shadow-xl shadow-indigo-100 text-white overflow-hidden relative group">
                    <div
                        class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <h3 class="text-xl font-bold mb-6 relative">Actions de Pointage</h3>
                    <div class="space-y-4 relative">
                        <a href="{{ route('attendance.check-in') }}"
                            class="w-full flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pointer l'Arrivée
                        </a>
                        <a href="{{ route('attendance.check-out') }}"
                            class="w-full flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Pointer le Départ
                        </a>
                    </div>
                    <p class="mt-8 text-indigo-200 text-xs font-bold text-center uppercase tracking-widest">Utilisation
                        libre • Accès Employés</p>
                </div>

                <!-- Management Shortcuts -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Gestion rapide</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('employees.index') }}"
                            class="flex flex-col items-center p-4 rounded-3xl bg-slate-50 hover:bg-slate-100 transition-colors group">
                            <div
                                class="p-3 bg-white rounded-2xl shadow-sm text-indigo-600 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="mt-3 text-sm font-bold text-slate-700">Employés</span>
                        </a>
                        <a href="{{ route('departments.index') }}"
                            class="flex flex-col items-center p-4 rounded-3xl bg-slate-50 hover:bg-slate-100 transition-colors group">
                            <div
                                class="p-3 bg-white rounded-2xl shadow-sm text-blue-600 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <span class="mt-3 text-sm font-bold text-slate-700">Départements</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection