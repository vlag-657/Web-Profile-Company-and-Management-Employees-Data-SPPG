<div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 rounded-full p-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" y1="8" x2="19" y2="14" />
                    <line x1="16" y1="11" x2="22" y2="11" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
                <p class="text-xs text-gray-500">{{ $subtitle }}</p>
            </div>
        </div>
        <button type="button" onclick="toggleModal('{{ $method === 'POST' ? 'modalTambah' : 'editModal' }}')"
            class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form id="{{ $method === 'PUT' ? 'editForm' : '' }}" method="POST" action="{{ $action }}"
        class="px-6 py-4 space-y-4" autocomplete="off">
        @csrf
        @if($method === 'PUT')
            @method('PUT')
            <input type="hidden" id="edit_karyawan_id" name="karyawan_id">
        @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" id="{{ $method === 'PUT' ? 'edit_nik' : '' }}" value="{{ old('nik') }}"
                    required autocomplete="off"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jabatan <span
                        class="text-red-500">*</span></label>
                <input type="text" name="jabatan" id="{{ $method === 'PUT' ? 'edit_jabatan' : '' }}"
                    value="{{ old('jabatan') }}" required autocomplete="off"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap <span
                    class="text-red-500">*</span></label>
            <input type="text" name="nama" id="{{ $method === 'PUT' ? 'edit_nama' : '' }}" value="{{ old('nama') }}"
                required autocomplete="off"
                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="{{ $method === 'PUT' ? 'edit_tanggal_lahir' : '' }}"
                    value="{{ old('tanggal_lahir') }}" autocomplete="off"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin <span
                        class="text-red-500">*</span></label>
                <select name="jenis_kelamin" id="{{ $method === 'PUT' ? 'edit_jenis_kelamin' : '' }}" required
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" id="{{ $method === 'PUT' ? 'edit_alamat' : '' }}" rows="2" autocomplete="off"
                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Password @if($method === 'POST')<span
                class="text-red-500">*</span>@endif</label>
                <div class="relative">
                    <input type="password" name="password" autocomplete="new-password" @if($method === 'POST') required
                    @endif
                        class="password-input mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button"
                        class="toggle-password-btn absolute inset-y-0 right-0 flex items-center pr-3 mt-1 text-gray-400 hover:text-gray-600">
                        <svg class="eye-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @if($method === 'PUT')
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password @if($method === 'POST')<span
                class="text-red-500">*</span>@endif</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" autocomplete="new-password"
                        @if($method === 'POST') required @endif
                        class="password-input mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button"
                        class="toggle-password-btn absolute inset-y-0 right-0 flex items-center pr-3 mt-1 text-gray-400 hover:text-gray-600">
                        <svg class="eye-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleModal('{{ $method === 'POST' ? 'modalTambah' : 'editModal' }}')"
                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</button>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">{{ $button }}</button>
        </div>
    </form>
</div>