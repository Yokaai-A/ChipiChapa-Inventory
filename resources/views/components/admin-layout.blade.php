<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PT ChipiChapa Admin') }} - Admin Area</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 flex h-screen overflow-hidden transition-colors duration-200">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 border-r border-gray-800 text-white min-h-screen flex flex-col shadow-2xl relative z-20">
        <div class="p-6 flex items-center gap-3 border-b border-gray-800">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div>
                <h2 class="text-xl font-black tracking-tight text-white">ChipiChapa</h2>
                <p class="text-xs text-indigo-300 font-medium">Admin Center</p>
            </div>
        </div>
        
        <div class="px-4 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Menu Manajemen
        </div>
        
        <nav class="flex-1 px-3 space-y-1">
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/50' : 'text-gray-300 hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="font-medium">Kategori Barang</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/50' : 'text-gray-300 hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="font-medium">Kelola Barang</span>
            </a>
        </nav>
        
        <div class="p-4 mx-4 mb-4 bg-gray-800 rounded-xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center font-bold text-xs uppercase">{{ substr(Auth::user()->nama_lengkap, 0, 2) }}</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->nama_lengkap }}</p>
                    <p class="text-xs text-gray-400 truncate">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-700 hover:bg-red-600 hover:text-white text-gray-300 text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-h-screen transition-all duration-300 overflow-y-auto w-full">
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-8 py-4 flex justify-between items-center sticky top-0 z-10 shadow-sm transition-colors duration-200">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $header ?? 'Dashboard' }}</h1>
            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                <!-- Dark Mode Toggle Button -->
                <button onclick="toggleDarkMode()" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-full p-2 transition-colors">
                    <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>
                <div>Halo, <span class="font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->nama_lengkap }}</span></div>
            </div>
        </header>
        
        <div class="p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            
            {{ $slot }}
        </div>
    </main>
</body>
</html>
