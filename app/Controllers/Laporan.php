<?php

namespace App\Controllers;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function produk_terlaris()
    {
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        $data = [
            'title'           => 'Laporan Produk Terlaris',
            'tanggal_awal'    => $tanggal_awal,
            'tanggal_akhir'   => $tanggal_akhir,
            'produk_terlaris' => $this->laporanModel->getProdukTerlaris($tanggal_awal, $tanggal_akhir)
        ];

        // Memanggil file produk_terlaris.php yang ada di root app/Views
        return view('produk_terlaris', $data); 
    }
}