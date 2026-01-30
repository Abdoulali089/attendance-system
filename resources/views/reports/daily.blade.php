@extends('layouts.app')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Rapport du Jour 📊</h1>
                <p class="mt-1 text-slate-500 font-medium">Aperçu détaillé des présences pour la date sélectionnée.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('reports.daily.export', ['date' => $date]) }}" 
                   class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Exporter CSV
                </a>
                <form action="{{ route('reports.daily') }}" method="GET" class="flex items-center space-x-2 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                    <input type="date" name="date" value="{{ $date }}" 
                        class="border-none focus:ring-0 text-gray-700 font-bold rounded-xl bg-slate-50"
                        onchange="this.form.submit()">
                </form>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 m-4">
            <!-- Present Card -->
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-500"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-black text-slate-400 uppercase tracking-widest">Présents</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-4xl font-black text-slate-900">{{ $stats['present'] }}</span>
                        <div class="h-1.5 w-12 bg-emerald-400 rounded-full mt-2"></div>
                    </div>
                </div>
            </div>

            <!-- Late Card -->
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-500"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-amber-50 rounded-2xl text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-black text-slate-400 uppercase tracking-widest">Retards</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-4xl font-black text-slate-900">{{ $stats['late'] }}</span>
                        <div class="h-1.5 w-12 bg-amber-400 rounded-full mt-2"></div>
                    </div>
                </div>
            </div>

            <!-- Absent Card -->
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-500"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-rose-50 rounded-2xl text-rose-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-black text-slate-400 uppercase tracking-widest">Absents</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-4xl font-black text-slate-900">{{ $stats['absent'] }}</span>
                        <div class="h-1.5 w-12 bg-rose-400 rounded-full mt-2"></div>
                    </div>
                </div>
            </div>

            <!-- Early Card -->
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-500"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-orange-50 rounded-2xl text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-black text-slate-400 uppercase tracking-widest">Départs Prématurés</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-4xl font-black text-slate-900">{{ $stats['early_departure'] }}</span>
                        <div class="h-1.5 w-12 bg-orange-400 rounded-full mt-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Details Table -->
        <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden m-4">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Détails des Présences 📜</h3>
                <div class="flex items-center px-4 py-2 bg-slate-50 rounded-2xl font-black text-slate-600 text-xs">
                    {{ count($attendances) }} Entrées totales
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Employé</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Départment</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Heure d'Entrée</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Heure de Sortie</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($attendances as $attendance)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5 m-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-black text-xs shadow-sm capitalize">
                                            {{ substr($attendance->employee->first_name, 0, 1) }}{{ substr($attendance->employee->last_name, 0, 1) }}
                                        </div>
                                        <div class="ml-4 text-sm font-black text-slate-900">
                                            {{ $attendance->employee->full_name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 m-4">
                                    <div class="text-xs font-bold text-slate-500 px-3 py-1 bg-slate-50 rounded-lg w-fit">
                                        {{ $attendance->employee->department->name }}
                                    </div>
                                </td>
                                <td class="px-8 py-5 m-4 text-sm font-black text-slate-800">
                                    {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '--:--' }}
                                </td>
                                <td class="px-8 py-5 m-4 text-sm font-black text-slate-400">
                                    {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '--:--' }}
                                </td>
                                <td class="px-8 py-5 m-4">
                                    @if($attendance->status === 'present')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-widest">
                                            Présent
                                        </span>
                                    @elseif($attendance->status === 'late')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-amber-50 text-amber-700 border border-amber-100 uppercase tracking-widest">
                                            Retard
                                        </span>
                                    @elseif($attendance->status === 'early_departure')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-orange-50 text-orange-700 border border-orange-100 uppercase tracking-widest">
                                            Parti tôt
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-widest">
                                            Absent
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 text-4xl mb-4">📭</div>
                                        <h3 class="text-xl font-bold text-slate-900">Aucun enregistrement pour cette date</h3>
                                        <p class="text-slate-500 mt-1">Veuillez sélectionner une autre date ou vérifier les pointages.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
