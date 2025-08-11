<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pembayaran::all();
        return view('menu.pembayaran.index', compact('data'));
    }

    public function index2()
    {
        $data = Pembayaran::where('id_user', Auth::user()->id)->get();
        return view('menu.user.pembayaran.index', compact('data'));
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
        //
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
        $data = Pembayaran::find($id);
        return view('menu.pembayaran.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:cash,transfer',
            'tgl_bayar' => 'nullable|date',
            'keterangan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'jumlah_bayar' => 'nullable|numeric',
        ]);

        $data = Pembayaran::findOrFail($id);

        // Update field biasa
        $data->metode_pembayaran = $request->metode_pembayaran;
        $data->tgl_bayar = $request->tgl_bayar;
        $data->jumlah_bayar = $request->jumlah_bayar;

        // Jika ada file baru yang diupload
        if ($request->hasFile('keterangan')) {
            // Hapus file lama jika ada
            if ($data->keterangan && Storage::disk('public')->exists($data->keterangan)) {
                Storage::disk('public')->delete($data->keterangan);
            }

            // Simpan file baru ke storage/app/public/keterangan
            $path = $request->file('keterangan')->store('keterangan', 'public');
            $data->keterangan = $path;
        }

        $data->save();

        return redirect()->route('Pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pembayaran::find($id);
        $data->delete();
        return redirect()->route('Pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus');
    }
}
