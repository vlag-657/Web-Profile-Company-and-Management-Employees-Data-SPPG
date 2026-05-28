<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ManajemenKaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('admin.index', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawans,nik',
            'nama' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->except('password_confirmation');
        $data['password'] = bcrypt($request->password);

        Karyawan::create($data); // <- PERBAIKAN: pakai $data, bukan $request->all()

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $rules = [
            'nik' => 'required|unique:karyawans,nik,' . $id,
            'nama' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $request->validate($rules);

        $data = $request->except('password_confirmation');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $karyawan->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}