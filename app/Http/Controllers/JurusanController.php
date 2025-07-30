<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jurusan::all();
        return view('menu.jurusan.index', compact('data'));
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
            'kode' => 'required|string|max:100',
            'name' => 'required|string|max:100',
        ]);
        // Simpan ke database
        Jurusan::create([
            'kode_jurusan' => $validated['kode'],
            'nama_jurusan' => $validated['name'],
        ]);

        return redirect()->route('Jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
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
        $user = Jurusan::find($id);
        return view('menu.jurusan.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kode_jurusan' => 'required|string|max:100',
            'nama_jurusan' => 'required|string|max:100',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($validated);

        return redirect()->route('Jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Jurusan::find($id);
        $data->delete();
        return redirect()->route('Jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
