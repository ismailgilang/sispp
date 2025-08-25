<?php

namespace App\PDF;

use TCPDF;

class CustomPDF extends TCPDF
{
    public function Header()
    {
        // Logo kiri
        $imageFile = public_path('images/login/lg.jpg');
        if (file_exists($imageFile)) {
            $this->Image($imageFile, 13, 10, 30); // X, Y, Width
        }

        // Posisi teks ke tengah halaman
        $this->SetXY(40, 18); // Geser ke kanan dari logo
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 10, 'SMK LUGINA RANCAEKEK', 0, 1, 'C');

        $this->SetX(40); // Pastikan horizontal posisi tetap
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 6, 'Jl. Raya Majalaya - Rancaekek Desa No.5, Bojongloa, Kec. Rancaekek, Kabupaten Bandung, Jawa Barat 40394', 0, 1, 'C');

        // Garis pembatas
        $this->Ln(8);
        $this->Line(15, $this->GetY(), 285, $this->GetY());
        $this->Ln(5); // Jarak ke konten bawah
    }
}
