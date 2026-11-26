<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportRent - Rental Alat Olahraga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-[#f3f4f6] dark:bg-[#090d16] text-gray-800 dark:text-gray-200 min-h-screen p-4 sm:p-8 transition-colors duration-300 font-sans">

    <div class="max-w-5xl mx-auto">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#131926] rounded-2xl p-6 sm:p-8 shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800/80">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Modul Alat Olahraga</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola data alat rental olahraga dengan tampilan yang interaktif.</p>
            </div>

            <div class="flex items-center gap-3">
                <!-- Toggle Tema -->
                <button onclick="toggleTheme()" type="button" title="Ubah Tema" class="p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-[#1e2638] text-gray-600 dark:text-yellow-400 transition-colors">
                    <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 dark:bg-rose-500/10 dark:hover:bg-rose-500/20 dark:text-rose-300 font-semibold text-sm px-4 py-2.5 rounded-xl transition-colors">
                        Logout
                    </button>
                </form>

                <!-- Tambah Alat -->
                <button type="button" onclick="openAddModal()" class="bg-[#5b46f6] hover:bg-[#4a35e0] text-white font-medium text-sm px-5 py-2.5 rounded-xl shadow-md shadow-indigo-500/20 transition-all whitespace-nowrap">
                    + Tambah Alat
                </button>
            </div>
        </div>

        <!-- PESAN BERHASIL -->
        @if (session('success'))
            <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/60 dark:bg-emerald-950/50 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-900/60 dark:bg-rose-950/50 dark:text-rose-300">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- TABEL DATA -->
        <div class="mt-6 bg-white dark:bg-[#131926] rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-wider text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-800/80">
                            <th class="px-6 py-4 font-semibold">No</th>
                            <th class="px-6 py-4 font-semibold">Kode Alat</th>
                            <th class="px-6 py-4 font-semibold">Nama Alat</th>
                            <th class="px-6 py-4 font-semibold">Jenis Alat</th>
                            <th class="px-6 py-4 font-semibold text-center">Kondisi</th>
                            <th class="px-6 py-4 font-semibold">Tarif Sewa</th>
                            <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800/80">
                        @forelse ($alat as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-[#1a2133] transition-colors">
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $item->kode_alat }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $item->nama_alat }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $item->jenis_alat }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($item->kondisi === 'Baik')
                                        <span class="inline-block rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20 px-3 py-1 text-xs font-semibold">{{ $item->kondisi }}</span>
                                    @else
                                        <span class="inline-block rounded-full bg-rose-50 text-rose-600 border border-rose-200 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20 px-3 py-1 text-xs font-semibold">{{ $item->kondisi }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">Rp {{ number_format($item->tarif_sewa, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button" onclick="openEditModal(@js($item))"
                                            class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:hover:bg-indigo-500/20 dark:text-indigo-300 text-xs font-semibold px-3.5 py-1.5 rounded-lg transition-colors">
                                            Edit
                                        </button>

                                        <form action="{{ route('alat.destroy', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-rose-50 hover:bg-rose-100 text-rose-600 dark:bg-rose-500/10 dark:hover:bg-rose-500/20 dark:text-rose-300 text-xs font-semibold px-3.5 py-1.5 rounded-lg transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400 dark:text-gray-500">
                                    Belum ada data alat olahraga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <!-- =================================
         POP UP TAMBAH ALAT
    ================================= -->
    <div id="addModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 p-4">
        <div class="relative w-full max-w-md max-h-[92vh] overflow-y-auto bg-white dark:bg-[#131926] rounded-2xl p-8 shadow-xl dark:shadow-none border border-gray-100 dark:border-gray-800/80">

            <button type="button" onclick="closeAddModal()" class="absolute top-5 right-6 text-2xl leading-none text-gray-400 hover:text-gray-700 dark:hover:text-white">&times;</button>

            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tambah Alat</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 mb-6">Masukkan informasi detail alat olahraga baru.</p>

            <form action="{{ route('alat.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="add_kode" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kode Alat</label>
                    <input type="text" id="add_kode" name="kode_alat" value="{{ old('edit_id') ? '' : old('kode_alat') }}" placeholder="Contoh: ALT001" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label for="add_nama" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama Alat</label>
                    <input type="text" id="add_nama" name="nama_alat" value="{{ old('edit_id') ? '' : old('nama_alat') }}" placeholder="Contoh: Raket Badminton" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label for="add_jenis" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Jenis Alat</label>
                    <select id="add_jenis" name="jenis_alat" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                        <option value="">-- Pilih Jenis Alat --</option>
                        @foreach (['Raket', 'Bola', 'Rompi', 'Perlengkapan'] as $opt)
                            <option value="{{ $opt }}" {{ !old('edit_id') && old('jenis_alat') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="add_kondisi" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kondisi</label>
                    <select id="add_kondisi" name="kondisi" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                        <option value="">-- Pilih Kondisi --</option>
                        @foreach (['Baik', 'Perlu Perbaikan'] as $opt)
                            <option value="{{ $opt }}" {{ !old('edit_id') && old('kondisi') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="add_tarif" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Tarif Sewa (Rp)</label>
                    <input type="number" id="add_tarif" name="tarif_sewa" value="{{ old('edit_id') ? '' : old('tarif_sewa') }}" placeholder="Contoh: 15000" min="0" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div class="flex items-center justify-between pt-4">
                    <button type="button" onclick="closeAddModal()" class="text-xs font-medium text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="bg-[#5b46f6] hover:bg-[#4a35e0] text-white font-medium text-xs px-6 py-3 rounded-xl shadow-md shadow-indigo-500/20 transition-all">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- =================================
         POP UP EDIT ALAT
    ================================= -->
    <div id="editModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 p-4">
        <div class="relative w-full max-w-md max-h-[92vh] overflow-y-auto bg-white dark:bg-[#131926] rounded-2xl p-8 shadow-xl dark:shadow-none border border-gray-100 dark:border-gray-800/80">

            <button type="button" onclick="closeEditModal()" class="absolute top-5 right-6 text-2xl leading-none text-gray-400 hover:text-gray-700 dark:hover:text-white">&times;</button>

            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Edit Alat</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 mb-6">Perbarui informasi detail alat olahraga.</p>

            <form id="editForm" action="{{ old('edit_id') ? url('/alat/' . old('edit_id')) : '' }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <input type="hidden" name="edit_id" id="edit_id" value="{{ old('edit_id') }}">

                <div>
                    <label for="edit_kode" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kode Alat</label>
                    <input type="text" id="edit_kode" name="kode_alat" value="{{ old('edit_id') ? old('kode_alat') : '' }}" placeholder="Contoh: ALT001" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label for="edit_nama" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama Alat</label>
                    <input type="text" id="edit_nama" name="nama_alat" value="{{ old('edit_id') ? old('nama_alat') : '' }}" placeholder="Contoh: Raket Badminton" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label for="edit_jenis" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Jenis Alat</label>
                    <select id="edit_jenis" name="jenis_alat" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                        @foreach (['Raket', 'Bola', 'Rompi', 'Perlengkapan'] as $opt)
                            <option value="{{ $opt }}" {{ old('edit_id') && old('jenis_alat') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="edit_kondisi" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kondisi</label>
                    <select id="edit_kondisi" name="kondisi" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                        @foreach (['Baik', 'Perlu Perbaikan'] as $opt)
                            <option value="{{ $opt }}" {{ old('edit_id') && old('kondisi') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="edit_tarif" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Tarif Sewa (Rp)</label>
                    <input type="number" id="edit_tarif" name="tarif_sewa" value="{{ old('edit_id') ? old('tarif_sewa') : '' }}" placeholder="Contoh: 15000" min="0" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl bg-gray-50 dark:bg-[#0d111a] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div class="flex items-center justify-between pt-4">
                    <button type="button" onclick="closeEditModal()" class="text-xs font-medium text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="bg-[#5b46f6] hover:bg-[#4a35e0] text-white font-medium text-xs px-6 py-3 rounded-xl shadow-md shadow-indigo-500/20 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- =================================
         JAVASCRIPT
    ================================= -->
    <script>
        const ALAT_URL = @json(url('/alat'));

        function showModal(id) {
            const m = document.getElementById(id);
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function hideModal(id) {
            const m = document.getElementById(id);
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        // POP UP TAMBAH
        function openAddModal()  { showModal('addModal'); }
        function closeAddModal() { hideModal('addModal'); }

        // POP UP EDIT (isi data dari baris yang diklik)
        function openEditModal(item) {
            document.getElementById('editForm').action = ALAT_URL + '/' + item.id;

            document.getElementById('edit_id').value = item.id;
            document.getElementById('edit_kode').value = item.kode_alat;
            document.getElementById('edit_nama').value = item.nama_alat;
            document.getElementById('edit_jenis').value = item.jenis_alat;
            document.getElementById('edit_kondisi').value = item.kondisi;
            document.getElementById('edit_tarif').value = item.tarif_sewa;

            showModal('editModal');
        }
        function closeEditModal() { hideModal('editModal'); }

        // TUTUP KETIKA KLIK BAGIAN LUAR POP UP
        document.querySelectorAll('#addModal, #editModal').forEach(modal => {
            modal.addEventListener('click', function (event) {
                if (event.target === this) hideModal(this.id);
            });
        });

        // TUTUP DENGAN TOMBOL ESC
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeAddModal();
                closeEditModal();
            }
        });

        // DARK MODE
        function toggleTheme() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        }

        @if ($errors->any() && session()->hasOldInput())
            @if (old('edit_id'))
                showModal('editModal');
            @else
                showModal('addModal');
            @endif
        @endif
    </script>

</body>
</html>