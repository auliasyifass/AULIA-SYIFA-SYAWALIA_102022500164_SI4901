@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
    <h1 class="mt-2 text-2xl font-bold">Masuk ke akun</h1>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gunakan email dan password akun Anda.</p>

    <form action="{{ route('login.store') }}" method="POST" class="mt-6 space-y-5">
        @csrf
        <label class="block text-sm font-medium">Email
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="mt-1.5 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-950" />
            @error('email')<span class="mt-1 block text-sm text-rose-600">{{ $message }}</span>@enderror
        </label>
        <label class="block text-sm font-medium">Password
            <input type="password" name="password" required autocomplete="current-password" class="mt-1.5 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-950" />
            @error('password')<span class="mt-1 block text-sm text-rose-600">{{ $message }}</span>@enderror
        </label>
        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
            <input type="checkbox" name="remember" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
            Ingat saya
        </label>
        <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white transition hover:bg-indigo-500">Masuk</button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">Belum memiliki akun? <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:underline dark:text-indigo-400">Daftar</a></p>
@endsection