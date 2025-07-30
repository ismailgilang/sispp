<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::all();
        $kelas = Kelas::all();
        return view('menu.siswa.index', compact('data', 'kelas'));
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
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswa,nis',
            'nama' => 'required|string|max:100',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required|string|min:6',
            'no_telp' => 'required|string|max:20',
        ]);

        // Simpan Siswa
        Siswa::create([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'id_kelas' => $validated['id_kelas'],
            'alamat' => $validated['alamat'],
            'no_telp' => $validated['no_telp'],
        ]);

        // Simpan User
        User::create([
            'nis' => $validated['nis'],
            'name' => $validated['nama'],
            'username' => $validated['nis'],
            'password' => Hash::make($validated['nis']),
            'role' => 'siswa',
        ]);

        return redirect()->route('Siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nis)
    {
        $siswa = Siswa::find($nis);
        $kelas = Kelas::all();
        return view('menu.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nis)
    {
        // Cari data siswa berdasarkan NIS
        $siswa = Siswa::findOrFail($nis);

        // Validasi
        $validated = $request->validate([
            'nis' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required|string|min:6',
            'no_telp' => 'required|string|max:20',
        ]);

        // Update data siswa
        $siswa->update([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'id_kelas' => $validated['id_kelas'],
            'alamat' => $validated['alamat'],
            'no_telp' => $validated['no_telp'],
        ]);

        // Update NIS di tabel user jika ada
        User::where('nis', $nis)->update([
            'name' => $validated['nama'],
        ]);

        return redirect()->route('Siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
