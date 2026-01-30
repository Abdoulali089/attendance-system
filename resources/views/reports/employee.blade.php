@extends('layouts.app')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Rapport d'Employé 👤</h1>
                <p class="mt-1 text-slate-500 font-medium">Historique d'assiduité individuel.</p>
            </div>
            <div class="flex items-center space-x-3">
                @if($selectedEmployee)
                    <a href="{{ route('reports.employee.export', ['employee_id' => $employeeId, 'month' => $month]) }}" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Exporter CSV
                    </a>
                @endif
                <form action="{{ route('reports.employee') }}" method="GET" class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2 bg-white p-2 rounded-3xl shadow-sm border border-slate-100">
                    <select name="employee_id" class="border-none focus:ring-0 text-gray-700 font-bold rounded-xl bg-slate-50 min-w-[200px]" onchange="this.form.submit()">
                        <option value="">Choisir un employé</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $employeeId == $employee->id ? 'selected' : '' }}>
                                {{ $employee->full_name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="month" name="month" value="{{ $month }}" 
                        class="border-none focus:ring-0 text-gray-700 font-bold rounded-xl bg-slate-50"
                        onchange="this.form.submit()">
                </form>
            </div>
        </div>

        @if ($selectedEmployee)
            <!-- Employee Profile Mini Card -->
            <div class="bg-indigo-600 p-8 rounded-[40px] shadow-2xl relative overflow-hidden m-4">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="h-20 w-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center text-white text-3xl font-black">
                            {{ substr($selectedEmployee->first_name, 0, 1) }}{{ substr($selectedEmployee->last_name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-white">{{ $selectedEmployee->full_name }}</h2>
                            <p class="text-indigo-100 font-bold uppercase tracking-widest text-sm mt-1">{{ $selectedEmployee->department->name }} • {{ $selectedEmployee->employee_code }}</p>
                        </div>
                    </div>
                    <div class="mt-6 md:mt-0 flex space-x-4">
                        <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl text-center min-w-[100px]">
                            <span class="block text-2xl font-black text-white">{{ count($attendances->where('status', 'present')) }}</span>
                            <span class="text-[10px] font-black text-indigo-100 uppercase">Présents</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl text-center min-w-[100px]">
                            <span class="block text-2xl font-black text-white">{{ count($attendances->where('status', 'late')) }}</span>
                            <span class="text-[10px] font-black text-indigo-100 uppercase">Retards</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance History Table -->
            <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden m-4">
                <div class="p-8 border-b border-slate-100">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Historique du Mois 📅</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Date</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Heure d'Entrée</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Heure de Sortie</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Statut</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse ($attendances as $attendance)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5 m-4">
                                        <div class="text-sm font-black text-slate-900">
                                            {{ $attendance->date->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 m-4">
                                        <div class="text-sm font-black text-slate-800">
                                            {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '--:--' }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 m-4">
                                        <div class="text-sm font-black text-slate-400">
                                            {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '--:--' }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 m-4">
                                        @if($attendance->status === 'present')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-widest">
                                                Présent
                                            </span>
                                        @elseif($attendance->status === 'late')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-amber-50 text-amber-700 border border-amber-100 uppercase tracking-widest">
                                                Retard ({{ $attendance->late_minutes }}m)
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
                                    <td class="px-8 py-5 m-4">
                                        <div class="text-xs text-slate-500 font-medium italic">
                                            {{ $attendance->notes ?: '-' }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 text-3xl mb-4">📅</div>
                                            <h3 class="text-lg font-bold text-slate-900">Aucun pointage trouvé</h3>
                                            <p class="text-slate-500 text-sm mt-1">Aucun enregistrement pour ce mois.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-[40px] border-2 border-dashed border-slate-200 p-20 text-center m-4">
                <div class="h-24 w-24 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-inner">🔍</div>
                <h2 class="text-2xl font-black text-slate-900">Sélectionnez un employé</h2>
                <p class="text-slate-500 mt-2 max-w-sm mx-auto font-medium">Veuillez choisir un employé dans la liste ci-dessus pour consulter ses rapports d'assiduité.</p>
            </div>
        @endif
    </div>
@endsection
