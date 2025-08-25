<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use App\pdf\custompdf;
use Carbon\Carbon;

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

    public function cetak(Request $request)
    {

        $periodeInput = $request->periode;
        $tipe = $request->periode_type;

        $jenis_periode = '';
        $label_periode = '';
        $startDate = null;
        $endDate = null;

        // Tangani tipe periode
        if ($tipe === "month") {
            $jenis_periode = "Perbulan";
            $label_periode = Carbon::parse($periodeInput)->translatedFormat('F Y');
            $startDate = Carbon::parse($periodeInput)->startOfMonth();
            $endDate = Carbon::parse($periodeInput)->endOfMonth();
        } elseif ($tipe === "year") {
            $jenis_periode = "Tahun Ajaran";
            $tahun = (int) $periodeInput; // Ambil 4 digit tahun
            $label_periode = $tahun;
            $startDate = Carbon::createFromDate($tahun, 1, 1)->startOfDay();
            $endDate = Carbon::createFromDate($tahun, 12, 31)->endOfDay();
        } elseif ($tipe === "periode") {
            // format "YYYY-MM-DD to YYYY-MM-DD"
            [$start, $end] = explode(' to ', $periodeInput);
            $jenis_periode = "Periode";
            $label_periode = Carbon::parse($start)->translatedFormat('d M Y') . ' s/d ' . Carbon::parse($end)->translatedFormat('d M Y');
            $startDate = Carbon::parse($start)->startOfDay();
            $endDate = Carbon::parse($end)->endOfDay();
        } else {
            // Default ke bulan jika tidak dikenali
            $jenis_periode = "Periode";
            $label_periode = Carbon::parse($periodeInput)->translatedFormat('F Y');
            $startDate = Carbon::parse($periodeInput)->startOfMonth();
            $endDate = Carbon::parse($periodeInput)->endOfMonth();
        }

        // Ambil data dari tabel Pembayaran
        $dataPembayaran = Pembayaran::with(['user', 'user.siswa.kelas', 'spp'])
            ->whereDate('created_at', '>=', $startDate->toDateString())
            ->whereDate('created_at', '<=', $endDate->toDateString())
            ->get();

        $jumlahSiswa = $dataPembayaran->count();

        // Inisialisasi PDF (Landscape)
        $pdf = new custompdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(15, 50, 15);
        $pdf->AddPage();

        // Judul
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 7, 'LAPORAN DATA SPP ' . strtoupper($jenis_periode), 0, 1, 'C');

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(5);

        // Informasi periode & jumlah
        $html = '
        <table cellpadding="2">
            <tr>
                <td width="15%"><strong>Jumlah Siswa</strong></td>
                <td>: ' . $jumlahSiswa . '</td>
            </tr>
            <tr>
                <td><strong>Tagihan SPP</strong></td>
                <td>: Rp.375.000</td>
            </tr>
            <tr>
                <td><strong>' . $jenis_periode . '</strong></td>
                <td>: ' . $label_periode . '</td>
            </tr>
        </table>
        <div></div>
        <table border="1" cellspacing="0" cellpadding="4">
            <thead>
                <tr style="background-color:#f0f0f0;">
                    <th width="5%" align="center">No</th>
                    <th width="10%" align="center">NISN</th>
                    <th width="20%" align="center">Nama</th>
                    <th width="10%" align="center">Kelas</th>
                    <th width="10%" align="center">Tagihan SPP</th>
                    <th width="10%" align="center">Keterangan</th>
                    <th width="10%" align="center">Pembayaran</th>
                    <th width="10%" align="center">Nominal</th>
                    <th width="16%" align="center">Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($dataPembayaran as $key => $item) {
            $html .= '
            <tr>
                <td width="5%" align="center">' . ($key + 1) . '</td>
                <td width="10%" align="center">' . $item->user->nis . '</td>
                <td width="20%" align="center">' . $item->user->name . '</td>
                <td width="10%" align="center">' . ($item->user->siswa->kelas->nama_kelas ?? '-') . '</td>
                <td width="10%" align="center">Rp.' . number_format($item->spp->nominal ?? 0, 0, ',', '.') . '</td>
                <td width="10%" align="center">' . ($item->spp->status ?? '-') . '</td>
                <td width="10%" align="center">' . $item->metode_pembayaran . '</td>
                <td width="10%" align="center">Rp.' . number_format($item->jumlah_bayar, 0, ',', '.') . '</td>
                <td width="16%" align="center">' . Carbon::parse($item->created_at)->translatedFormat('d-m-Y') . '</td>
            </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, false, false, '');

        // Output PDF
        $pdf->Output('Laporan_SPP.pdf', 'I');
    }
}
