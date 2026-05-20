<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalLaki = Karyawan::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Karyawan::where('jenis_kelamin', 'Perempuan')->count();
        $karyawans = Karyawan::all();
        return view('dashboard', compact('totalKaryawan', 'totalLaki', 'totalPerempuan', 'karyawans'));
    }
}