<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'nik' => 'required|string',
        ]);
        $karyawan = Karyawan::where('nik', $request->nik)->first();

        if ($karyawan) {
            session(['karyawan_id' => $karyawan->id, 'karyawan_nama' => $karyawan->nama]);
            return redirect()->route('karyawan.absensi');
        }
        return back()->withErrors(['nik' => 'NIK tidak ditemukan lurr'])->withInput();
    }

    public function logout()
    {
        session()->forget(['karyawan_id', 'karyawan_nama']);
        return redirect()->route('login.karyawan.form');
    }
}
