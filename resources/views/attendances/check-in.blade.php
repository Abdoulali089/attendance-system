@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[calc(100vh-140px)]">
        <div class="w-full max-w-xl">
            <!-- Decoration -->
            <div class="relative h-3 w-32 bg-indigo-600 rounded-t-3xl mx-auto opacity-20"></div>

            <div class="bg-white rounded-[40px] shadow-2xl shadow-indigo-100/50 border border-slate-100 overflow-hidden">
                <!-- Header Section -->
                <div class="bg-slate-50 px-10 py-10 border-b border-slate-100 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-100/50 rounded-full blur-3xl"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">C'est l'heure ! ⏱️</h2>
                            <p class="mt-2 text-slate-500 font-bold uppercase tracking-widest text-xs">Enregistrez votre
                                arrivée</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-black text-indigo-600" id="current-time">{{ now()->format('H:i:s') }}
                            </p>
                            <p class="text-xs font-bold text-slate-400">{{ now()->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="p-10">
                    <form action="{{ route('attendance.check-in.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <div>
                            <label for="employee_id"
                                class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-4">
                                Qui êtes-vous ?
                            </label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <select id="employee_id" name="employee_id" required
                                    class="block w-full pl-16 pr-5 py-5 rounded-3xl border-2 border-slate-100 bg-slate-50 text-slate-900 font-bold text-lg focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all appearance-none">
                                    <option value="">Choisir mon nom...</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->full_name }} — {{ $employee->department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            @error('employee_id')
                                <p class="text-rose-500 text-xs font-bold mt-3 ml-2 flex items-center">
                                    <span class="mr-1">⚠️</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-6 px-10 rounded-3xl shadow-xl shadow-indigo-100 hover:shadow-indigo-200 transform transition hover:scale-[1.02] active:scale-95 flex items-center justify-center group">
                            <span class="text-xl">Pointer mon Arrivée</span>
                            <svg class="ml-3 h-6 w-6 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>

                        <div class="flex items-center justify-center">
                            <div class="h-px bg-slate-100 flex-1"></div>
                            <span class="px-4 text-slate-300 text-xs font-bold uppercase tracking-widest">Vérification
                                Automatisée</span>
                            <div class="h-px bg-slate-100 flex-1"></div>
                        </div>

                        <a href="{{ route('dashboard') }}"
                            class="w-full flex items-center justify-center text-slate-400 hover:text-slate-600 font-bold text-sm transition-colors">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour au dashboard
                        </a>
                    </form>
                </div>
            </div>
            <!-- Footer Info -->
            <p class="text-center mt-8 text-slate-400 text-xs font-medium">
                Le pointage génère un horodatage précis utilisé pour le calcul de votre présence.
            </p>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            document.getElementById('current-time').textContent = timeString;
        }
        setInterval(updateTime, 1000);
    </script>
@endsection