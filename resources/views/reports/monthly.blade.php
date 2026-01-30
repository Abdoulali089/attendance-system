@extends('layouts.app')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Rapport Mensuel 📅</h1>
                <p class="mt-1 text-slate-500 font-medium">Récapitulatif des présences par mois.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('reports.monthly.export', ['month' => $month]) }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Exporter CSV
                </a>
                <form action="{{ route('reports.monthly') }}" method="GET"
                    class="flex items-center space-x-2 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                    <input type="month" name="month" value="{{ $month }}"
                        class="border-none focus:ring-0 text-gray-700 font-bold rounded-xl bg-slate-50"
                        onchange="this.form.submit()">
                </form>
            </div>
        </div>

        <!-- Monthly Summary Table -->
        <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden m-4">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Statistiques par Employé 📊</h3>
                <div class="flex items-center px-4 py-2 bg-indigo-50 rounded-2xl font-black text-indigo-600 text-xs">
                    {{ Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Employé</th>
                            <th
                                class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Présents</th>
                            <th
                                class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Retards</th>
                            <th
                                class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Partis Tôt</th>
                            <th
                                class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Absents</th>
                            <th
                                class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Taux de Présence</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($reportData as $data)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5 m-4">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-black text-xs shadow-sm capitalize">
                                            {{ substr($data['employee']->first_name, 0, 1) }}{{ substr($data['employee']->last_name, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-black text-slate-900">{{ $data['employee']->full_name }}
                                            </div>
                                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                                {{ $data['employee']->department->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center m-4">
                                    <span
                                        class="text-sm font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">{{ $data['present'] }}</span>
                                </td>
                                <td class="px-8 py-5 text-center m-4">
                                    <span
                                        class="text-sm font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-full">{{ $data['late'] }}</span>
                                </td>
                                <td class="px-8 py-5 text-center m-4">
                                    <span
                                        class="text-sm font-black text-orange-600 bg-orange-50 px-3 py-1 rounded-full">{{ $data['early'] }}</span>
                                </td>
                                <td class="px-8 py-5 text-center m-4">
                                    <span
                                        class="text-sm font-black text-rose-600 bg-rose-50 px-3 py-1 rounded-full">{{ $data['absent'] }}</span>
                                </td>
                                <td class="px-8 py-5 text-center m-4">
                                    @php
                                        $presenceRate = $data['total'] > 0 ? round(($data['present'] / $data['total']) * 100) : 0;
                                    @endphp
                                    <div class="flex items-center justify-center flex-col">
                                        <span class="text-xs font-black text-slate-900">{{ $presenceRate }}%</span>
                                        <div class="w-16 h-1.5 bg-slate-100 rounded-full mt-1 overflow-hidden">
                                            <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $presenceRate }}%">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 text-4xl mb-4">
                                            📈</div>
                                        <h3 class="text-xl font-bold text-slate-900">Pas assez de données</h3>
                                        <p class="text-slate-500 mt-1">Commencez à marquer les présences pour voir les
                                            statistiques mensuelles.</p>
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