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
                        <a href="{{ route('departments.index') }}"
                            class="ml-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">Départements</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-black text-slate-900 uppercase tracking-wider">Nouveau</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-10 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 text-indigo-600 rounded-[24px] mb-4 shadow-sm border border-indigo-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Nouveau Département 🏢</h1>
            <p class="mt-2 text-slate-500 font-medium">Définissez un nouveau pôle d'activité pour l'entreprise.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[40px] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('departments.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-black text-slate-700 mb-3 ml-1">Nom du
                            Département</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300"
                            placeholder="ex: Ressources Humaines" required>
                        @error('name')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-black text-slate-700 mb-3 ml-1">Code Identifiant</label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300 uppercase"
                            placeholder="ex: RH, IT, LOG" required>
                        @error('code')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-black text-slate-700 mb-3 ml-1">Description
                            (Optionnel)</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300"
                            placeholder="Quelles sont les responsabilités de ce département ?">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 flex items-center justify-between border-t border-slate-100">
                        <a href="{{ route('departments.index') }}"
                            class="px-8 py-4 rounded-2xl text-slate-400 font-bold hover:text-slate-600 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg mb-4">
                            Créer le Département
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection