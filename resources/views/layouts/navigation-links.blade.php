<!-- Dashboard -->
<a href="{{ route('dashboard') }}"
    class="sidebar-item group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all-200 {{ request()->routeIs('dashboard') ? 'sidebar-item-active' : 'text-slate-600' }}">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
    </svg>
    Dashboard
</a>

<!-- Départements -->
<a href="{{ route('departments.index') }}"
    class="sidebar-item group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all-200 {{ request()->routeIs('departments.*') ? 'sidebar-item-active' : 'text-slate-600' }}">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
    </svg>
    Départements
</a>

<!-- Employés -->
<a href="{{ route('employees.index') }}"
    class="sidebar-item group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all-200 {{ request()->routeIs('employees.*') ? 'sidebar-item-active' : 'text-slate-600' }}">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
    Employés
</a>

<!-- Présences -->
<a href="{{ route('attendances.index') }}"
    class="sidebar-item group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all-200 {{ request()->routeIs('attendances.*') ? 'sidebar-item-active' : 'text-slate-600' }}">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
    </svg>
    Présences
</a>

<!-- Rapports -->
<a href="{{ route('reports.daily') }}"
    class="sidebar-item group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all-200 {{ request()->routeIs('reports.*') ? 'sidebar-item-active' : 'text-slate-600' }}">
    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
    </svg>
    Rapports
</a>