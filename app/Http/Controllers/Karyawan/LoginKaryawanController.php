<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class LoginKaryawanController extends Controller
{
    public function showLoginForm()
    {
        return view('karyawan.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        //cari karyawan berdasarkan NIK
        $karyawan = \App\Models\Karyawan::where('nik', $request->nik)->first();

        //jika NIK gak ditemukan/pw salah
        if (!$karyawan || !\Illuminate\Support\Facades\Hash::check($request->password, $karyawan->password)) {
            return back()->with('error', 'NIK atau password salah.');
        }

        //simpan data ke session
        session(['karyawan_login' => $karyawan->id, 'karyawan_nama' => $karyawan->nama]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Selamat datang, ' . $karyawan->nama);
    }

    public function dashboard()
    {
        //ambil data karyawan dari session
        $karyawanId = session('karyawan_login');
        if (!$karyawanId) {
            return redirect()->route('karyawan.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $karyawan = \App\Models\Karyawan::find($karyawanId);
        if (!$karyawan) {
            return redirect()->route('karyawan.login')->with('error', 'Data karyawan tidak ditemukan.');
        }

        return view('karyawan.dashboard', compact('karyawan'));
    }

    public function absen(Request $request)
    {
        $karyawanId = session('karyawan_login');
        if (!$karyawanId) {
            return redirect()->route('karyawan.dashboard')->with('success', 'Absen berhasil dikirim. Terima kasih.');
        }

        $request->validate([
            'job' => 'required|in:Dapur,Supir,Lainnya',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $today = Carbon::now()->toDateString();

        // Cek apakah sudah absen hari ini
        $sudahAbsen = Absensi::where('karyawan_id', $karyawanId)
            ->where('tanggal', $today)
            ->exists();
        if ($sudahAbsen) {
            return back()->with('error', 'Anda sudah melakukan absen hari ini.');
        }

        Absensi::create([
            'karyawan_id' => $karyawanId,
            'tanggal' => $today,
            'job' => $request->job,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Absen berhasil dikirim. Terima kasih.');
    }

    public function logout()
    {
        session()->forget('karyawan_login');
        session()->forget('karyawan_nama');
        return redirect()->route('karyawan.login')->with('success', 'Anda telah logout.');
    }
}
