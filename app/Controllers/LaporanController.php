<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
    public function pendapatan()
    {
        $model = new TransactionModel();
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $laporan = [];
        if ($tanggal_awal && $tanggal_akhir) {
            $laporan = $model
                ->where('status >=', 1) // only Paid and above
                ->where('created_at >=', $tanggal_awal . ' 00:00:00')
                ->where('created_at <=', $tanggal_akhir . ' 23:59:59')
                ->findAll();
        }
        return view('laporan_pendapatan', [
            'laporan' => $laporan,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
    }
    public function exportPdf()
    { // Gunakan library dompdf
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $model = new \App\Models\TransactionModel();
        $laporan = $model
            ->where('status >=', 1)
            ->where('created_at >=', $tanggal_awal . ' 00:00:00')
            ->where('created_at <=', $tanggal_akhir . ' 23:59:59')
            ->findAll();
        $dompdf = new \Dompdf\Dompdf();
        $html = view('laporan_pdf', [
            'laporan' => $laporan,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("laporan-pendapatan.pdf");
    }
    public function exportExcel()
    {
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $model = new \App\Models\TransactionModel();
        $laporan = $model
            ->where('status >=', 1)
            ->where('created_at >=', $tanggal_awal . ' 00:00:00')
            ->where('created_at <=', $tanggal_akhir . ' 23:59:59')
            ->findAll();
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=laporan-pendapatan.xls");
        echo view('laporan_excel', ['laporan' => $laporan]);
    }

    public function daftar_piutang()
    {
        $laporanModel = new \App\Models\LaporanModel();

        $data = [
            'title'   => 'Laporan Piutang Pelanggan',
            'piutang' => $laporanModel->getDaftarPiutang()
        ];

        return view('daftar_piutang', $data);
    }

    public function update_pembayaran()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $tambah_bayar = $this->request->getPost('tambah_bayar');

        if ($id_transaksi && $tambah_bayar) {
            $db = \Config\Database::connect();
            $builder = $db->table('transaction');

            $transaksi = $builder->where('id', $id_transaksi)->get()->getRowArray();

            if ($transaksi) {
                $total_dibayar_baru = $transaksi['sudah_dibayar'] + $tambah_bayar;

                $data_update = [
                    'sudah_dibayar' => $total_dibayar_baru
                ];

                if ($total_dibayar_baru >= $transaksi['total_harga']) {
                    $data_update['status'] = 1;
                }

                $builder->where('id', $id_transaksi)->update($data_update);

                if ($total_dibayar_baru >= $transaksi['total_harga']) {
                    session()->setFlashdata('pesan', 'Pembayaran Invoice #INV-' . $id_transaksi . ' berhasil ditambahkan dan Tagihan LUNAS!');
                } else {
                    session()->setFlashdata('pesan', 'Pembayaran cicilan untuk Invoice #INV-' . $id_transaksi . ' berhasil ditambahkan!');
                }
            }
        }

        return redirect()->to(base_url('daftar_piutang'));
    }

    public function exportPdfPiutang()
    {
        $laporanModel = new \App\Models\LaporanModel();
        $data = [
            'title'   => 'Laporan Piutang Pelanggan',
            'piutang' => $laporanModel->getDaftarPiutang()
        ];

        $html = view('cetak_piutang', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_Piutang_Pelanggan_' . date('Ymd') . '.pdf', ['Attachment' => true]);
    }

    public function exportExcelPiutang()
    {
        $laporanModel = new \App\Models\LaporanModel();
        $data = [
            'title'   => 'Laporan Piutang Pelanggan',
            'piutang' => $laporanModel->getDaftarPiutang()
        ];

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Piutang_Pelanggan_" . date('Ymd') . ".xls");

        return view('cetak_piutang', $data);
    }

    public function arus_kas()
    {
        $db = \Config\Database::connect();
        $queryPenjualan = $db->table('transaction')->selectSum('sudah_dibayar')->get()->getRow();
        $totalPenjualan = $queryPenjualan->sudah_dibayar ?? 0;
        $arusKasModel = new \App\Models\ArusKasModel();
        $dataArusKas = $arusKasModel->orderBy('tanggal', 'ASC')->findAll();
        $data = [
            'title'           => 'Laporan Arus Kas',
            'total_penjualan' => $totalPenjualan,
            'arus_kas'        => $dataArusKas
        ];
        return view('laporan_arus_kas', $data);
    }

    public function simpan_arus_kas()
    {
        $arusKasModel = new \App\Models\ArusKasModel();
        $arusKasModel->save([
            'tanggal'    => $this->request->getPost('tanggal'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tipe'       => $this->request->getPost('tipe'),
            'nominal'    => $this->request->getPost('nominal'),
        ]);
        session()->setFlashdata('pesan', 'Catatan arus kas berhasil ditambahkan!');
        return redirect()->to(base_url('laporan_arus_kas'));
    }

    public function exportPdfArusKas()
    {
        $db = \Config\Database::connect();

        $queryPenjualan = $db->table('transaction')->selectSum('sudah_dibayar')->get()->getRow();
        $totalPenjualan = $queryPenjualan->sudah_dibayar ?? 0;

        $arusKasModel = new \App\Models\ArusKasModel();
        $dataArusKas = $arusKasModel->orderBy('tanggal', 'ASC')->findAll();

        $data = [
            'total_penjualan' => $totalPenjualan,
            'arus_kas'        => $dataArusKas
        ];

        $html = view('cetak_arus_kas', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan_Arus_Kas_' . date('Ymd') . '.pdf', ['Attachment' => true]);
    }

    public function exportExcelArusKas()
    {
        $db = \Config\Database::connect();

        $queryPenjualan = $db->table('transaction')->selectSum('sudah_dibayar')->get()->getRow();
        $totalPenjualan = $queryPenjualan->sudah_dibayar ?? 0;

        $arusKasModel = new \App\Models\ArusKasModel();
        $dataArusKas = $arusKasModel->orderBy('tanggal', 'ASC')->findAll();

        $data = [
            'total_penjualan' => $totalPenjualan,
            'arus_kas'        => $dataArusKas
        ];

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Arus_Kas_" . date('Ymd') . ".xls");

        return view('cetak_arus_kas', $data);
    }

    public function laba_rugi()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();

        $tanggal_awal = $request->getGet('tanggal_awal');
        $tanggal_akhir = $request->getGet('tanggal_akhir');

        $builderPenjualan = $db->table('transaction');
        if ($tanggal_awal && $tanggal_akhir) {
            $builderPenjualan->where('created_at >=', $tanggal_awal . ' 00:00:00');
            $builderPenjualan->where('created_at <=', $tanggal_akhir . ' 23:59:59');
        }
        $penjualan = $builderPenjualan->selectSum('sudah_dibayar')->get()->getRow()->sudah_dibayar ?? 0;

        // 1. Hitung HPP dengan query yang lebih aman
        $builderHPP = $db->table('transaction_detail AS td');

        // Menggunakan select() dengan perhitungan manual
        $builderHPP->select('SUM(td.jumlah * p.harga_beli) AS total_hpp');

        // Melakukan JOIN dengan tabel produk dan transaksi
        $builderHPP->join('product AS p', 'p.id = td.product_id', 'left');
        $builderHPP->join('transaction AS t', 't.id = td.transaction_id', 'left');

        // Hanya hitung barang yang sudah terjual (status >= 1)
        $builderHPP->where('t.status >=', 1);

        // Filter tanggal jika ada
        if ($tanggal_awal && $tanggal_akhir) {
            $builderHPP->where('t.created_at >=', $tanggal_awal . ' 00:00:00');
            $builderHPP->where('t.created_at <=', $tanggal_akhir . ' 23:59:59');
        }

        $hasil = $builderHPP->get()->getRow();
        $hpp = $hasil ? $hasil->total_hpp : 0;

        $builderBeban = $db->table('arus_kas')
            ->where('tipe', 'Keluar')
            ->notLike('keterangan', 'Pembelian Stok');
        if ($tanggal_awal && $tanggal_akhir) {
            $builderBeban->where('tanggal >=', $tanggal_awal);
            $builderBeban->where('tanggal <=', $tanggal_akhir);
        }
        $beban = $builderBeban->selectSum('nominal')->get()->getRow()->nominal ?? 0;

        $laba_kotor = $penjualan - $hpp;
        $laba_bersih = $laba_kotor - $beban;

        $data = [
            'title'         => 'Laporan Laba Rugi',
            'tanggal_awal'  => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'penjualan'     => $penjualan,
            'hpp'           => $hpp,
            'beban'         => $beban,
            'laba_kotor'    => $laba_kotor,
            'laba_bersih'   => $laba_bersih
        ];

        return view('laporan_laba_rugi', $data);
    }

    public function exportPdfLabaRugi()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();

        $tanggal_awal = $request->getGet('tanggal_awal');
        $tanggal_akhir = $request->getGet('tanggal_akhir');

        $builderPenjualan = $db->table('transaction');
        if ($tanggal_awal && $tanggal_akhir) {
            $builderPenjualan->where('created_at >=', $tanggal_awal . ' 00:00:00');
            $builderPenjualan->where('created_at <=', $tanggal_akhir . ' 23:59:59');
        }
        $penjualan = $builderPenjualan->selectSum('sudah_dibayar')->get()->getRow()->sudah_dibayar ?? 0;

        // 1. Hitung HPP dengan query yang lebih aman
        $builderHPP = $db->table('transaction_detail AS td');

        // Menggunakan select() dengan perhitungan manual
        $builderHPP->select('SUM(td.jumlah * p.harga_beli) AS total_hpp');

        // Melakukan JOIN dengan tabel produk dan transaksi
        $builderHPP->join('product AS p', 'p.id = td.product_id', 'left');
        $builderHPP->join('transaction AS t', 't.id = td.transaction_id', 'left');

        // Hanya hitung barang yang sudah terjual (status >= 1)
        $builderHPP->where('t.status >=', 1);

        // Filter tanggal jika ada
        if ($tanggal_awal && $tanggal_akhir) {
            $builderHPP->where('t.created_at >=', $tanggal_awal . ' 00:00:00');
            $builderHPP->where('t.created_at <=', $tanggal_akhir . ' 23:59:59');
        }

        $hasil = $builderHPP->get()->getRow();
        $hpp = $hasil ? $hasil->total_hpp : 0;

        $builderBeban = $db->table('arus_kas')
            ->where('tipe', 'Keluar')
            ->notLike('keterangan', 'Pembelian Stok');
        if ($tanggal_awal && $tanggal_akhir) {
            $builderBeban->where('tanggal >=', $tanggal_awal);
            $builderBeban->where('tanggal <=', $tanggal_akhir);
        }
        $beban = $builderBeban->selectSum('nominal')->get()->getRow()->nominal ?? 0;

        $laba_kotor = $penjualan - $hpp;
        $laba_bersih = $laba_kotor - $beban;

        $data = [
            'tanggal_awal'  => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'penjualan'     => $penjualan,
            'hpp'           => $hpp,
            'beban'         => $beban,
            'laba_kotor'    => $laba_kotor,
            'laba_bersih'   => $laba_bersih
        ];

        $html = view('cetak_laba_rugi', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan_Laba_Rugi_' . date('Ymd') . '.pdf', ['Attachment' => true]);
    }
}
