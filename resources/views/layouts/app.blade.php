<!DOCTYPE html>
<html lang="fr" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Système de Présence') }} | Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .sidebar-item-active {
            background: linear-gradient(to right, #4F46E5, #6366F1);
            color: white !important;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }

        .sidebar-item:hover:not(.sidebar-item-active) {
            background-color: #F1F5F9;
            transform: translateX(4px);
        }

        .transition-all-200 {
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>

<body class="min-h-full bg-slate-50 text-slate-900 antialiased" x-data="{ mobileMenuOpen: false }">
    <div class="flex min-h-screen">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileMenuOpen" class="fixed inset-0 z-40 flex md:hidden" role="dialog" aria-modal="true" x-cloak>
            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-600 bg-opacity-75 backdrop-blur-sm"
                @click="mobileMenuOpen = false" aria-hidden="true"></div>

            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="relative flex-1 flex flex-col max-w-xs w-full bg-white shadow-2xl">

                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        @click="mobileMenuOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4 mb-8">
                        <div class="bg-indigo-600 p-2 rounded-xl shadow-lg shadow-indigo-200 mr-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-800">Attendance<span
                                class="text-indigo-600">Pro</span></span>
                    </div>
                    <nav class="px-2 space-y-2">
                        @include('layouts.navigation-links')
                    </nav>
                </div>
            </div>
        </div>
        <aside class="hidden md:flex md:flex-shrink-0 sticky top-0 h-screen">
            <div class="flex flex-col w-64 border-r border-slate-200 bg-white h-full">
                <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4 mb-8">
                        <div class="bg-indigo-600 p-2 rounded-xl shadow-lg shadow-indigo-200 mr-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-800">Attendance<span
                                class="text-indigo-600">Pro</span></span>
                    </div>

                    <nav class="flex-1 px-3 space-y-2">
                        @include('layouts.navigation-links')
                    </nav>
                </div>

                <!-- User Footer -->
                <div class="flex-shrink-0 flex border-t border-slate-200 p-4">
                    <div class="flex-shrink-0 w-full group block">
                        <div class="flex items-center">
                            <div>
                                <div
                                    class="h-9 w-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold border-2 border-slate-100 shadow-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs font-semibold text-slate-700 truncate w-24">
                                    {{ auth()->user()->name }}
                                </p>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-xs font-medium text-indigo-500 hover:text-indigo-700">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 min-w-0 bg-slate-50">
            <header
                class="sticky top-0 z-30 w-full h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 flex-shrink-0">
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = true"
                        class="text-slate-500 hover:text-indigo-600 p-2 rounded-lg hover:bg-slate-50 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="ml-4 text-lg font-bold text-slate-800 tracking-tight">Attendance<span
                            class="text-indigo-600">Pro</span></span>
                </div>
                <div class="flex-1 flex justify-end">
                    <div
                        class="max-w-lg w-full lg:max-w-xs relative text-slate-400 focus-within:text-indigo-500 hidden sm:block">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input id="search" name="search"
                            class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm transition-all"
                            placeholder="Rechercher..." type="search">
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <!-- Notifications/Alerts -->
                @if(session('success'))
                    <div class="max-w-7xl mx-auto mb-6">
                        <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0 text-emerald-400">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="max-w-7xl mx-auto mb-6">
                        <div class="bg-rose-50 border-l-4 border-rose-400 p-4 rounded-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0 text-rose-400">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>