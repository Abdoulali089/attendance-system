@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto pb-12">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('attendances.index') }}"
                            class="ml-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">Présences</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-black text-slate-900 uppercase tracking-wider">Manuel</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-10 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-emerald-50 text-emerald-600 rounded-[24px] mb-4 shadow-sm border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Pointage Manuel ⏱️</h1>
            <p class="mt-2 text-slate-500 font-medium">Enregistrez une présence manuellement pour un collaborateur.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[40px] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('attendances.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div>
                        <label for="employee_id" class="block text-sm font-black text-slate-700 mb-3 ml-1">Employé</label>
                        <select id="employee_id" name="employee_id"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all appearance-none cursor-pointer">
                            <option value="">Sélectionner un collaborateur</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->full_name }} ({{ $employee->employee_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="date" class="block text-sm font-black text-slate-700 mb-3 ml-1">Date</label>
                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all"
                                required>
                            @error('date')
                                <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="check_in" class="block text-sm font-black text-slate-700 mb-3 ml-1">Heure
                                d'Arrivée</label>
                            <input type="time" name="check_in" id="check_in" value="{{ old('check_in', date('H:i')) }}"
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all"
                                required>
                            @error('check_in')
                                <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-black text-slate-700 mb-3 ml-1">Notes ou
                            Justificatif</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all placeholder-slate-300"
                            placeholder="Précisez la raison du pointage manuel...">{{ old('notes') }}</textarea>
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
                            class="px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl shadow-xl shadow-emerald-100 hover:bg-emerald-700 transform transition hover:scale-[1.02] active:scale-95">
                            Valider la Présence
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection