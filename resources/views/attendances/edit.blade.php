@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto pb-12">
        <!-- Page Header -->
        <div class="mb-10 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-amber-50 text-amber-600 rounded-[24px] mb-4 shadow-sm border border-amber-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Modifier / Sortie ⏱️</h1>
            <p class="mt-2 text-slate-500 font-medium">
                Employé: <span class="text-indigo-600 font-bold">{{ $attendance->employee->full_name }}</span> |
                Date: <span class="font-bold">{{ $attendance->date->format('d/m/Y') }}</span>
            </p>
        </div>

        <div class="bg-white rounded-[40px] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('attendances.update', $attendance) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="check_in" class="block text-sm font-black text-slate-700 mb-3 ml-1">Heure
                            d'arrivée</label>
                        <input type="time" name="check_in" id="check_in"
                            value="{{ old('check_in', $attendance->check_in ? $attendance->check_in->format('H:i') : '') }}"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-100 border-2 border-slate-100 text-slate-400 font-bold cursor-not-allowed"
                            disabled>
                        <p class="text-xs text-slate-400 mt-2 ml-1">L'heure d'arrivée est enregistrée et ne peut être
                            modifiée.</p>
                    </div>

                    <div>
                        <label for="check_out" class="block text-sm font-black text-slate-700 mb-3 ml-1">Heure de
                            départ</label>
                        <input type="time" name="check_out" id="check_out"
                            value="{{ old('check_out', $attendance->check_out ? $attendance->check_out->format('H:i') : date('H:i')) }}"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all"
                            required>
                        @error('check_out')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-black text-slate-700 mb-3 ml-1">Notes
                            (Optionnel)</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300"
                            placeholder="Ajoutez une note ici...">{{ old('notes', $attendance->notes) }}</textarea>
                        @error('notes')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 flex items-center justify-between border-t border-slate-100">
                        <a href="{{ route('attendances.index') }}"
                            class="px-8 py-4 rounded-2xl text-slate-400 font-bold hover:text-slate-600 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg mb-4">
                            Valider la Modification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection