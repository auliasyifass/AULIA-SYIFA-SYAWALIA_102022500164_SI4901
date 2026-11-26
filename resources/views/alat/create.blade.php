<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alat - SportRent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-[#f3f4f6] dark:bg-[#090d16] text-gray-800 dark:text-gray-200 min-h-screen flex items-center justify-center p-4 transition-colors duration-300 font-sans">

    <div class="w-full max-w-md bg-white dark:bg-[#131926] rounded-2xl p-8 shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800/80 relative">

        <!-- Toggle Theme Pojok Kanan Atas -->
        <button onclick="toggleTheme()" type="button" class="absolute top-6 right-6 p-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-[#1e2638] text-gray-600 dark:text-yellow-400 transition-colors">
            <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </button>

        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tambah Alat</h2>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 mb-6">Masukkan informasi detail alat olahraga baru.</p>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs text-rose-700 dark:border-rose-900/60 dark:bg-rose-950/50 dark:text-rose-300">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('alat.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="kode_alat" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kode Alat</label>
                <input type="text" id="kode_alat" name="kode_alat" value="{{ old('kode_alat') }}" placeholder="Contoh: ALT001" required
                    class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
            </div>

            <div>
                <label for="nama_alat" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama Alat</label>
                <input type="text" id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}" placeholder="Contoh: Raket Badminton" required
                    class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
            </div>

            <div>
                <label for="jenis_alat" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Jenis Alat</label>
                <select id="jenis_alat" name="jenis_alat" required
                    class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                    <option value="">-- Pilih Jenis Alat --</option>
                    @foreach (['Raket', 'Bola', 'Rompi', 'Perlengkapan'] as $opt)
                        <option value="{{ $opt }}" {{ old('jenis_alat') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kondisi" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kondisi</label>
                <select id="kondisi" name="kondisi" required
                    class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                    <option value="">-- Pilih Kondisi --</option>
                    @foreach (['Baik', 'Perlu Perbaikan'] as $opt)
                        <option value="{{ $opt }}" {{ old('kondisi') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tarif_sewa" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Tarif Sewa (Rp)</label>
                <input type="number" id="tarif_sewa" name="tarif_sewa" value="{{ old('tarif_sewa') }}" placeholder="Contoh: 15000" min="0" required
                    class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
            </div>

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('alat.index') }}" class="text-xs font-medium text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white transition-colors">
                    Kembali
                </a>
                <button type="submit" class="bg-[#5b46f6] hover:bg-[#4a35e0] text-white font-medium text-xs px-6 py-3 rounded-xl shadow-md shadow-indigo-500/20 transition-all">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        }
    </script>
</body>
</html>