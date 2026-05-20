<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <button id="btnTambah"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200 mb-4">Tambah
                        Karyawan</button>

                    <div id="modalTambah"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-all duration-300">
                        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">

                            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 rounded-full p-2">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <line x1="19" y1="8" x2="19" y2="14" />
                                            <line x1="16" y1="11" x2="22" y2="11" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Tambah Karyawan</h3>
                                        <p class="text-xs text-gray-500">Isi data karyawan baru</p>
                                    </div>
                                </div>
                                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- form -->
                            <form method="POST" action="{{ route('karyawan.store') }}" class="px-6 py-4 space-y-4">
                                @csrf
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">NIK <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="nik" required
                                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jabatan <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="jabatan" required
                                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nama" required
                                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir"
                                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin <span
                                                class="text-red-500">*</span></label>
                                        <select name="jenis_kelamin" required
                                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih</option>
                                            <option>Laki-laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="alamat" rows="2"
                                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div class="flex justify-end gap-3 pt-2">
                                    <button type="button" id="cancelBtn"
                                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">Simpan
                                        Karyawan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- tabel -->
                    <!-- Tabel data karyawan -->
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NIK</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Lahir</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Alamat</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jenis Kelamin</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jabatan</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($karyawans ?? [] as $karyawan)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $karyawan->nik }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $karyawan->nama }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-600">{{ $karyawan->tanggal_lahir ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600">
                                            {{ Str::limit($karyawan->alamat ?? '-', 50) }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-600">{{ $karyawan->jenis_kelamin }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-600">{{ $karyawan->jabatan }}</td>
                                        <td class="px-4 py-2 text-sm">
                                            <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                            <button class="text-red-600 hover:text-red-800">Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data karyawan.
                                            Silakan tambah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const modal = document.getElementById('modalTambah');
        const btnTambah = document.getElementById('btnTambah');
        const closeBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        function openModal() { modal.classList.remove('hidden'); }
        function closeModal() { modal.classList.add('hidden'); }

        btnTambah.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    </script>
</x-app-layout>