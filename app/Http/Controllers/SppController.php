<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Spp::all();
        $data2 = Jurusan::all();
        $data3 = Siswa::all();
        return view('menu.spp.index', compact('data', 'data2', 'data3'));
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
            'nis' => 'required|exists:siswa,nis',
            'nominal' => 'required|numeric|min:1000',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2000',
            'jatuh_tempo' => 'required|date',
        ]);

        Spp::create([
            'nis' => $validated['nis'],
            'nominal' => $validated['nominal'],
            'bulan' => $validated['bulan'],
            'tahun' => $validated['tahun'],
            'jatuh_tempo' => $validated['jatuh_tempo'],
        ]);

        return redirect()->route('Spp.index')->with('success', 'Tagihan SPP berhasil ditambahkan!');
    }

    public function store2(Request $request)
    {
        $validated = $request->validate([
            'id_jurusan'  => 'required|exists:jurusan,id',
            'nominal'     => 'required|numeric|min:1000',
            'bulan'       => 'required|integer|between:1,12',
            'tahun'       => 'required|integer|min:2000',
            'jatuh_tempo' => 'required|date',
        ]);

        // 1. Ambil semua kelas dengan id_jurusan yang sama
        $kelasList = Kelas::where('id_jurusan', $validated['id_jurusan'])->pluck('id');

        if ($kelasList->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada kelas untuk jurusan ini.');
        }

        // 2. Ambil semua siswa berdasarkan id_kelas yang ada
        $siswaList = Siswa::whereIn('id_kelas', $kelasList)->pluck('nis');

        if ($siswaList->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada siswa untuk jurusan ini.');
        }

        // 3. Buat tagihan SPP untuk setiap NIS
        foreach ($siswaList as $nis) {
            Spp::create([
                'nis'         => $nis,
                'nominal'     => $validated['nominal'],
                'bulan'       => $validated['bulan'],
                'tahun'       => $validated['tahun'],
                'jatuh_tempo' => $validated['jatuh_tempo'],
            ]);
        }

        return redirect()->route('Spp.index')->with('success', 'Tagihan SPP untuk semua siswa di jurusan ini berhasil dibuat!');
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
        //
    }

    public function bayar(string $id)
    {
        $data = Spp::find($id);
        return view('menu.spp.bayar', compact('data'));
    }

    public function bayar2(Request $request, string $id)
    {
        $validated = $request->validate([
            'status'            => 'required|in:belum_dibayar,lunas',
            'tanggal_bayar'     => 'nullable|date',
            'jumlah_bayar'      => 'nullable|numeric|min:0',
            'metode_pembayaran' => 'nullable|in:cash,transfer',
            'keterangan'        => 'nullable|string|max:255',
        ]);

        // 2. Cari data SPP berdasarkan ID
        $spp = Spp::findOrFail($id);

        // 3. Update hanya field status
        $spp->update([
            'status' => $validated['status'],
        ]);

        // 4. Jika ada data pembayaran (minimal tanggal_bayar & jumlah_bayar), buat record baru
        if ($request->filled('tanggal_bayar') && $request->filled('jumlah_bayar')) {
            // Ambil user dengan NIS yang sama dari tabel users
            $user = User::where('nis', $spp->nis)->first();
            $id_user = $user ? $user->id : null;

            Pembayaran::create([
                'id_spp'            => $spp->id,
                'tgl_bayar'         => $validated['tanggal_bayar'],
                'jumlah_bayar'      => $validated['jumlah_bayar'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'keterangan'        => $validated['keterangan'] ?? null,
                'id_user'           => $id_user,
            ]);
        }

        return redirect()->route('Spp.index')->with('success', 'Data SPP dan pembayaran berhasil diperbarui.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
