<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SportRent</title>
    @include('layouts._head')
</head>
<body class="relative flex min-h-screen items-center justify-center bg-gray-100 p-4 font-sans text-gray-900 dark:bg-gray-950 dark:text-gray-100">

    {{-- Tombol mode gelap / terang --}}
    <button onclick="toggleTheme()" type="button" title="Ubah Tema"
            class="group absolute right-5 top-5 flex items-center justify-center rounded-xl bg-gray-200 p-2.5 text-gray-800 shadow-md hover:scale-110 active:scale-95 dark:bg-gray-800 dark:text-yellow-400">
        <svg class="hidden h-5 w-5 transition-transform duration-300 group-hover:rotate-90 dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <svg class="block h-5 w-5 transition-transform duration-300 group-hover:-rotate-12 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>

    <main class="w-full max-w-md rounded-2xl border border-gray-200 bg-white p-8 shadow-xl dark:border-gray-800 dark:bg-gray-900">
        <p class="text-sm font-semibold uppercase text-indigo-600 dark:text-indigo-400">SportRent</p>
        @yield('content')
    </main>
</body>
</html>