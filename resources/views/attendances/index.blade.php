@extends('layouts.app')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Journal d'Assiduité 📋</h1>
                <p class="mt-1 text-slate-500 font-medium">Suivi en temps réel des entrées et sorties du personnel.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('attendances.create') }}"
                    class="inline-flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Pointage Manuel
                </a>
            </div>
        </div>

        <!-- Filters/Stats (Small) -->
        <div class="flex items-center space-x-4 bg-white p-4 rounded-3xl border border-slate-100 shadow-sm w-fit m-4">
            <div class="flex items-center px-4 py-2 bg-indigo-50 rounded-2xl">
                <span class="text-xs font-black text-indigo-600 uppercase tracking-widest">Aujourd'hui:
                    {{ now()->format('d/m/Y') }}</span>
            </div>
            <div class="h-4 w-px bg-slate-100"></div>
            <div class="text-xs font-bold text-slate-500 uppercase tracking-widest px-2">
                {{ $attendances->total() }} Enregistrements
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden m-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Employé</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4 ">
                                Arrivée</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4">
                                Départ</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest m-4">
                                Statut</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-widest m-4">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($attendances as $attendance)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5 m-4">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-black text-xs shadow-sm capitalize">
                                            {{ substr($attendance->employee->first_name, 0, 1) }}{{ substr($attendance->employee->last_name, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-black text-slate-900">
                                                {{ $attendance->employee->full_name }}
                                            </div>
                                            <div class="text-xs font-bold text-slate-400 mt-0.5">
                                                {{ $attendance->employee->department->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 m-4">
                                    <div class="flex items-center text-sm font-black text-slate-800">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2"></span>
                                        {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '--:--' }}
                                    </div>
                                </td>
                                <td class="px-8 py-5 m-4">
                                    <div
                                        class="flex items-center text-sm font-black text-slate-400 group-hover:text-slate-600 transition-colors">
                                        <span class="w-2 h-2 rounded-full bg-slate-200 mr-2"></span>
                                        {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '--:--' }}
                                    </div>
                                </td>
                                <td class="px-8 py-5 m-4">
                                    @if($attendance->status === 'present')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-widest">
                                            Présent
                                        </span>
                                    @elseif($attendance->status === 'late')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-amber-50 text-amber-700 border border-amber-100 uppercase tracking-widest">
                                            Retard ({{ $attendance->late_minutes }}m)
                                        </span>
                                    @elseif($attendance->status === 'early_departure')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-orange-50 text-orange-700 border border-orange-100 uppercase tracking-widest">
                                            Parti tôt
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-widest">
                                            Absent
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-right m-4">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('attendances.edit', $attendance) }}"
                                            class="p-2.5 rounded-xl bg-white text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-100 transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('attendances.destroy', $attendance) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2.5 rounded-xl bg-white text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-100 transition-all shadow-sm"
                                                onclick="return confirm('Supprimer cet enregistrement ?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 text-4xl mb-4">
                                            📝</div>
                                        <h3 class="text-xl font-bold text-slate-900">Aucune assiduité aujourd'hui</h3>
                                        <p class="text-slate-500 mt-1">Les pointages de la journée apparaîtront ici.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $attendances->links() }}
        </div>
    </div>
@endsection