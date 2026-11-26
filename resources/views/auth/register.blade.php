@extends('layouts.guest')

@section('title', 'Daftar')

@section('content')
    <h1 class="mt-2 text-2xl font-bold">Buat akun</h1>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Daftarkan akun untuk mengelola data alat olahraga.</p>

    <form action="{{ route('register.store') }}" method="POST" class="mt-6 space-y-5">
        @csrf
        <label class="block text-sm font-medium">Nama lengkap
            <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="mt-1.5 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-950" />
            @error('name')<span class="mt-1 block text-sm text-rose-600">{{ $message }}</span>@enderror
        </label>
        <label class="block text-sm font-medium">Email
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="mt-1.5 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-950" />
            @error('email')<span class="mt-1 block text-sm text-rose-600">{{ $message }}</span>@enderror
        </label>
        <label class="block text-sm font-medium">Password
            <input type="password" name="password" required autocomplete="new-password" class="mt-1.5 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-950" />
            @error('password')<span class="mt-1 block text-sm text-rose-600">{{ $message }}</span>@enderror
        </label>
        <label class="block text-sm font-medium">Konfirmasi password
            <input type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1.5 w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-950" />
        </label>
        <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white transition hover:bg-indigo-500">Daftar</button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">Sudah memiliki akun? <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline dark:text-indigo-400">Masuk</a></p>
@endsection