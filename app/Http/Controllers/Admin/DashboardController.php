<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Absensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalLaki = Karyawan::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Karyawan::where('jenis_kelamin', 'Perempuan')->count();
        $karyawans = Karyawan::all();

        // Ambil absensi hari ini
        $absensiHariIni = Absensi::with('karyawan')
            ->whereDate('tanggal', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalKaryawan', 
            'totalLaki', 
            'totalPerempuan', 
            'karyawans', 
            'absensiHariIni'
        ));
    }
}