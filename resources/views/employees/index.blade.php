@extends('layouts.app')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Candidats & Employés 👥</h1>
                <p class="mt-1 text-slate-500 font-medium">Gérez votre effectif et leurs accès au système.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('employees.create') }}"
                    class="inline-flex items-center justify-center px-6 py-4 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-50 hover:scale-[1.03] transition-all transform duration-200 shadow-lg mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouvel Employé
                </a>
            </div>
        </div>

        <!-- Stats Overview (Optional but looks premium) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center space-x-4">
                <div class="p-3 mr-6 bg-indigo-50 text-indigo-600 rounded-2xl font-black">
                    {{ $employees->total() }}
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-widest"> Total Employés</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center space-x-4">
                <div class="p-3 mr-6 bg-emerald-50 text-emerald-600 rounded-2xl font-black">
                    {{ $employees->where('status', 'active')->count() }}
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-widest"> Actifs</div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center space-x-4">
                <div class="p-3 mr-6 bg-rose-50 text-rose-600 rounded-2xl font-black">
                    {{ $employees->where('status', 'inactive')->count() }}
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-widest"> Inactifs</div>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                Employé</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                Département</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                Contact</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                Statut</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-widest">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($employees as $employee)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center">
                                        <div
                                            class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm shadow-sm border border-indigo-100">
                                            {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-black text-slate-900">{{ $employee->full_name }}</div>
                                            <div class="text-xs font-bold text-slate-400 mt-0.5">#{{ $employee->employee_code }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $employee->department->name }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-slate-700">{{ $employee->user->email }}</div>
                                    <div class="text-xs text-slate-400">{{ $employee->phone }}</div>
                                </td>
                                <td class="px-8 py-5">
                                    @if($employee->status === 'active')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                            Actif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-rose-50 text-rose-700 border border-rose-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-2"></span>
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('employees.edit', $employee) }}"
                                            class="p-2.5 rounded-xl bg-white text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-100 transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2.5 rounded-xl bg-white text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-100 transition-all shadow-sm"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">
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
                                            👤</div>
                                        <h3 class="text-xl font-bold text-slate-900">Aucun employé trouvé</h3>
                                        <p class="text-slate-500 mt-1">Commencez par ajouter votre premier collaborateur.</p>
                                        <a href="{{ route('employees.create') }}"
                                            class="mt-6 text-indigo-600 font-black hover:underline">Ajouter un employé</a>
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
            {{ $employees->links() }}
        </div>
    </div>
@endsection