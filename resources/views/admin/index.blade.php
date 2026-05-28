@php
    $modalClass = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-all duration-300';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Data Karyawan') }}</h2>
    </x-slot>

    <div id="toastContainer"
        class="fixed top-5 left-1/2 -translate-x-1/2 z-[9999] flex flex-col items-center gap-2 w-full max-w-sm px-4 pointer-events-none">
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button id="btnTambah"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition mb-4">Tambah
                        Karyawan</button>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach (['NIK', 'Nama', 'Tanggal Lahir', 'Alamat', 'Jenis Kelamin', 'Jabatan', 'Aksi'] as $head)
                                        <th
                                            class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ $head }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($karyawans as $karyawan)
                                    <tr>
                                        <td class="px-4 py-2">{{ $karyawan->nik }}</td>
                                        <td class="px-4 py-2 font-medium">{{ $karyawan->nama }}</td>
                                        <td class="px-4 py-2">{{ $karyawan->tanggal_lahir ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ Str::limit($karyawan->alamat ?? '-', 50) }}</td>
                                        <td class="px-4 py-2">{{ $karyawan->jenis_kelamin }}</td>
                                        <td class="px-4 py-2">{{ $karyawan->jabatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button type="button" class="edit-btn text-blue-600 hover:text-blue-800 mr-3"
                                                data-karyawan='@json($karyawan)'>
                                                <i class="fas fa-edit text-lg"></i>
                                            </button>
                                            <button type="button"
                                                onclick="openDeleteModal({{ $karyawan->id }}, '{{ addslashes($karyawan->nama) }}')"
                                                class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash-alt text-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data karyawan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- modal tambah -->
    <div id="modalTambah" class="{{ $modalClass }}">
        @include('admin.partials.form-karyawan', [
            'title' => 'Tambah Karyawan',
            'subtitle' => 'Isi data karyawan baru',
            'action' => route('karyawan.store'),
            'method' => 'POST',
            'button' => 'Simpan Karyawan'
        ])
    </div>

<!-- modal edit -->
    <div id="editModal" class="{{ $modalClass }}">
        @include('admin.partials.form-karyawan', [
            'title' => 'Edit Data Karyawan',
            'subtitle' => 'Ubah data karyawan',
            'action' => old('karyawan_id') ? url('karyawan/' . old('karyawan_id')) : '#',
            'method' => 'PUT',
            'button' => 'Perbarui Karyawan'
        ])
    </div>

<!-- modal hapus -->
    <div id="deleteModal" class="{{ $modalClass }}">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border
                   -b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-red-100 rounded-full p-2">

                                                   <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>

                                        <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h3>
                        <p class="text-xs text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
                <button type="button" onclick="toggleModal('deleteModal')" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                        <path stroke-
                   linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-700">Apakah Anda yakin ingin menghapus karyawan <strong id="deleteNama"></strong>?</p>
                    <p class="text-sm text-gray-500 mt-1">Data akan dihapus secara permanen.</p>
                </div>
                <form id="deleteForm" method="POST" class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="toggleModal('deleteModal')" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition">Ya, Hapus</button>
                </form>
            </div>
        </div>
    
    <script>
// modal + reset pw
        window.toggleModal = (id, show = false) =>  {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden', !show);
            if (!show) {
                // Reset password fields ketika modal ditutup
                const passwordInputs = modal.querySelectorAll('.password-input, input[type="password"]');
                passwordInputs.forEach(input => input.value = '');
            }
        };
    
        //toggle pw untuk semua modal
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.toggle-password-btn');
        if (!btn) return;
            const input = btn.parentElement.querySelector('.password-input');
            if (!input) return;
            const icon = btn.querySelector('.eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
    });
    
        function showToast(type, messages) {
        const container = document.getElementById('toastContainer');
            const isError = type === 'error';
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto w-full rounded-xl shadow-lg px-4 py-3 flex gap-3 items-start transition-all duration-500 ${isError ? 'bg-red-50 border border-red-300 text-red-800' : 'bg-green-50 border border-green-300 text-green-800'}`;
            toast.innerHTML = `<div class="flex-1"><p class="font-semibold text-sm">${isError ? 'Terjadi kesalahan:' : 'Berhasil!'}</p><ul class="list-disc list-inside text-sm mt-1">${messages.map(m => `<li>${m}</li>`).join('')}</ul></div><button onclick="this.closest('[data-toast]').remove()" class="text-xs font-semibold px-2 py-1 rounded-md bg-white/60">OK</button>`;
            toast.setAttribute('data-toast', '1');
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 6000);
        }
        document.getElementById('btnTambah').addEventListener('click', () => window.toggleModal('modalTambah', true));
    
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const data = JSON.parse(btn.dataset.karyawan);
                ['nik', 'nama', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'jabatan'].forEach(field => {
                    document.getElementById(`edit_${field}`).value = data[field] || '';
                });
            document.getElementById('edit_karyawan_id').value = data.id;
                document.getElementById('editForm').action = `{{ url('karyawan') }}/${data.id}`;
                window.toggleModal('editModal', true);
        });
        });

        function openDeleteModal(id, nama) {
        document.getElementById('deleteNama').innerText = nama;
        document.getElementById('deleteForm').action = `{{ url('karyawan') }}/${id}`;
    window.toggleModal('deleteModal', true);
}
//notif succes
@if(session('success'))
    showToast('success', [@json(session('success'))]);
@endif

        //munculkan modal lagi jika error validasi
        @if($errors->any())
            showToast('error', @json($errors->all()));
                @if(old('_method') === 'PUT')
                    window.toggleModal('editModal', true);
                    ['nik', 'nama', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'jabatan'].forEach(field => {
                        document.getElementById(`edit_${field}`).value = @json(old())[field] || '';
                    });
                    document.getElementById('edit_karyawan_id').value = @json(old('karyawan_id'));
                @else
                    window.toggleModal('modalTambah', true);
                @endif
        @endif
</script>
    
</x-app-layout>