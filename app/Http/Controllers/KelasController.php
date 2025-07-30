<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kelas::all();
        $jurusan = Jurusan::all();
        return view('menu.kelas.index', compact('data', 'jurusan'));
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
        // Validasi data
        $validated = $request->validate([
            'nama_kelas' => 'nullable|string|max:100|',
            'jurusan' => 'required|string|max:100',
            'angkatan' => 'required|string|max:50',
        ]);

        // Simpan ke database
        Kelas::create([
            'nama_kelas' => $validated['nama_kelas'] ?? null,
            'id_jurusan' => $validated['jurusan'],
            'angkatan' => $validated['angkatan'],
        ]);

        return redirect()->route('Kelas.index')->with('success', 'Kelas berhasil ditambahkan');
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
    public function edit(string $id)
    {
        $kelas = Kelas::find($id);
        $jurusan = Jurusan::all();
        return view('menu.kelas.edit', compact('kelas', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'jurusan' => 'required|exists:jurusan,id',
            'angkatan' => 'required|digits:4',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $validated['nama_kelas'],
            'id_jurusan' => $validated['jurusan'],
            'angkatan' => $validated['angkatan'],
        ]);

        return redirect()->route('Kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kelas::find($id);
        $data->delete();
        return redirect()->route('Kelas.index')->with('success', 'Data Kelas berhasil dihapus');
    }
}
