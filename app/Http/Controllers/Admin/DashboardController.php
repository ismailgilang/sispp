<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanSekarang = date('F'); // Output: February (bahasa Inggris)
        $tahunSekarang = date('Y');

        // Konversi bulan Inggris ke Indonesia
        $bulanIndonesia = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $bulanSekarangIndo = $bulanIndonesia[$bulanSekarang];
        $totalBelum = Spp::where('status', 'belum dibayar')
            ->where('bulan', $bulanSekarangIndo)
            ->where('tahun', $tahunSekarang)
            ->sum('nominal');

        $totalLunas = Spp::where('status', 'lunas')
            ->where('bulan', $bulanSekarangIndo)
            ->where('tahun', $tahunSekarang)
            ->sum('nominal');

        $siswaSekarang = Siswa::whereYear('created_at', $tahunSekarang)
            ->count();

        $siswa = Siswa::count();
        $kelas = Kelas::count();
        $sppbelum = Spp::where('status', 'belum dibayar')->count();
        $spplunas = Spp::where('status', 'lunas')->count();

        return view('menu.index', compact('bulanSekarang', 'tahunSekarang', 'siswa', 'siswaSekarang', 'kelas', 'sppbelum', 'totalBelum', 'totalLunas', 'spplunas'));
    }
}
