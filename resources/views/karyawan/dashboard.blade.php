<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen py-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-center">Dashboard Karyawan</h2>
            <div class="mb-4 text-center">
                <p class="text-gray-700">Selamat datang, <strong>{{ $karyawan->nama }}</strong>!</p>
                <p>NIK: {{ $karyawan->nik }} | Jabatan: {{ $karyawan->jabatan }}</p>
            </div>

            <hr class="my-6">

            <h3 class="text-xl font-semibold mb-4">Form Absen Hari Ini</h3>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('karyawan.absen.submit') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Pekerjaan Hari Ini <span
                            class="text-red-500">*</span></label>
                    <select name="job" required
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="Dapur">Dapur</option>
                        <option value="Supir">Supir</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Keterangan (jika memilih Lainnya, isi di
                        sini)</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Misalnya: Membantu distribusi makanan..."></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kirim
                        Absen</button>
                </div>
            </form>

            <!-- Form logout terpisah di luar form absen -->
            <form method="POST" action="{{ route('karyawan.logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Logout</button>
            </form>
        </div>
    </div>
</body>

</html>