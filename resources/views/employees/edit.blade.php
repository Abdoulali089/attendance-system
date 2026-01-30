@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto pb-12">
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
                        <a href="{{ route('employees.index') }}"
                            class="ml-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">Employés</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-black text-slate-900 uppercase tracking-wider">Modifier Profil</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Modifier : {{ $employee->full_name }} ✏️</h1>
            <p class="mt-2 text-lg text-slate-500 font-medium">Mettez à jour les informations du collaborateur.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[40px] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-12">
                <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <div>
                        <h3 class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em] mb-8 flex items-center">
                            <span class="w-8 h-px bg-indigo-100 mr-4"></span>
                            Informations Personnelles
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="first_name"
                                    class="block text-sm font-black text-slate-700 mb-3 ml-1">Prénom</label>
                                <input type="text" name="first_name" id="first_name"
                                    value="{{ old('first_name', $employee->first_name) }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300"
                                    required>
                                @error('first_name')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-black text-slate-700 mb-3 ml-1">Nom</label>
                                <input type="text" name="last_name" id="last_name"
                                    value="{{ old('last_name', $employee->last_name) }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300"
                                    required>
                                @error('last_name')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-black text-slate-700 mb-3 ml-1">Adresse
                                    Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $employee->user->email) }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300"
                                    required>
                                @error('email')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone"
                                    class="block text-sm font-black text-slate-700 mb-3 ml-1">Téléphone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300">
                                @error('phone')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <h3 class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em] mb-8 flex items-center">
                            <span class="w-8 h-px bg-indigo-100 mr-4"></span>
                            Détails Professionnels
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="employee_code" class="block text-sm font-black text-slate-700 mb-3 ml-1">Code
                                    Employé</label>
                                <input type="text" name="employee_code" id="employee_code"
                                    value="{{ old('employee_code', $employee->employee_code) }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all placeholder-slate-300 uppercase"
                                    required>
                                @error('employee_code')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="department_id"
                                    class="block text-sm font-black text-slate-700 mb-3 ml-1">Département</label>
                                <select id="department_id" name="department_id"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all appearance-none cursor-pointer">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-black text-slate-700 mb-3 ml-1">Type de
                                    Profil</label>
                                <select id="type" name="type"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all appearance-none cursor-pointer">
                                    <option value="employee" {{ old('type', $employee->type) == 'employee' ? 'selected' : '' }}>Employé</option>
                                    <option value="student" {{ old('type', $employee->type) == 'student' ? 'selected' : '' }}>
                                        Étudiant</option>
                                </select>
                                @error('type')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-black text-slate-700 mb-3 ml-1">État de
                                    l'Accès</label>
                                <select id="status" name="status"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-slate-50 text-slate-900 font-bold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all appearance-none cursor-pointer">
                                    <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Actif</option>
                                    <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                </select>
                                @error('status')
                                    <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 flex items-center justify-between border-t border-slate-100">
                        <a href="{{ route('employees.index') }}"
                            class="px-8 py-4 rounded-2xl text-slate-400 font-bold hover:text-slate-600 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg mb-4">
                            Mettre à Jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection