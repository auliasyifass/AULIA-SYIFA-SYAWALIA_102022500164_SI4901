<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SportRent</title>

    @include('layouts._head')
</head>

<body class="min-h-screen bg-slate-100 font-sans text-slate-700 transition-colors dark:bg-slate-900 dark:text-slate-200">

    {{-- SIDEBAR --}}
    <aside class="flex flex-col bg-brand px-4 py-6 text-white dark:bg-slate-950 sm:fixed sm:inset-y-0 sm:left-0 sm:w-56 lg:w-64">
        <div class="text-2xl font-bold">SportRent</div>
        <div class="mb-8 mt-1 text-sm text-blue-200">Rental Alat Olahraga</div>

        <div class="mx-2 mb-2 text-xs uppercase text-blue-200/80">Menu</div>

        <a href="{{ route('alat.index') }}"
           class="mb-2 block rounded-md px-4 py-3 hover:bg-brand-soft dark:hover:bg-slate-800 {{ request()->routeIs('alat.index') ? 'bg-brand-soft dark:bg-slate-800' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('alat.create') }}"
           class="mb-2 block rounded-md px-4 py-3 hover:bg-brand-soft dark:hover:bg-slate-800 {{ request()->routeIs('alat.create') ? 'bg-brand-soft dark:bg-slate-800' : '' }}">
            Tambah Alat
        </a>

        {{-- USER & LOGOUT --}}
        <div class="mt-4 border-t border-white/20 pt-4">
            <div class="mx-2 mb-2 truncate text-sm text-blue-200">{{ auth()->user()->name }}</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full cursor-pointer rounded-md bg-red-600/90 px-4 py-3 text-left text-sm text-white hover:bg-red-600">
                    Keluar
                </button>
            </form>
        </div>
        {{-- TOMBOL MODE GELAP / TERANG --}}
        <button onclick="toggleTheme()" type="button"
                class="mt-4 flex items-center gap-2 rounded-md border border-white/20 px-4 py-3 text-sm hover:bg-white/10 sm:absolute sm:bottom-6 sm:left-4 sm:right-4 sm:mt-0">
            {{-- ikon bulan (tampil saat mode terang) --}}
            <svg class="h-5 w-5 dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/>
            </svg>
            {{-- ikon matahari (tampil saat mode gelap) --}}
            <svg class="hidden h-5 w-5 dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="4"/>
                <path stroke-linecap="round" d="M12 2v2m0 16v2M4.9 4.9l1.4 1.4m11.4 11.4 1.4 1.4M2 12h2m16 0h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>
            </svg>
            <span class="dark:hidden">Mode Gelap</span>
            <span class="hidden dark:inline">Mode Terang</span>
        </button>
    </aside>

    {{-- ISI HALAMAN --}}
    <main class="p-5 sm:ml-56 sm:p-8 lg:ml-64">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-brand dark:text-sky-300">@yield('heading')</h1>
                <p class="text-slate-500 dark:text-slate-400">@yield('subheading')</p>
            </div>
            @yield('header-action')
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-md bg-green-100 px-4 py-3 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 rounded-md bg-red-100 px-4 py-3 text-red-800 dark:bg-red-900/40 dark:text-red-300">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>