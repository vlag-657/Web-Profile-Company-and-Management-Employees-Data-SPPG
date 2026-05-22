<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ManajemenKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawans,nik',
            'nama' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required',
        ]);
        Karyawan::create($request->all());
        return redirect()->route('admin.karyawan.index')->with('succes', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $request->validate([
            'nik' => 'required|unique:karyawans,nik,' . $id,
            'nama' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required',
        ]);
        $karyawan->update($request->all());
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $karyawan = Karyawan::findOrFail($id);
    $karyawan->delete();
    return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
}
}
