<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProductModel;
use App\Models\ArusKasModel; // Pastikan ini ada
use Dompdf\Dompdf;

class ProdukController extends BaseController
{
    protected $productModel;
    protected $arusKasModel; // 1. Tambahkan deklarasi properti di sini

    function __construct()
    {
        helper('form');
        $this->productModel = new ProductModel();
        $this->arusKasModel = new ArusKasModel(); // 2. Inisialisasi model di sini
    }

    public function index()
    {
        return view('produk/index', [
            'products' => $this->productModel->findAll()
        ]);
    }

    public function create()
    {
        $dataFoto = $this->request->getFile('foto');

        $nama       = $this->request->getPost('nama');
        $harga_beli = $this->request->getPost('harga_beli');
        $harga      = $this->request->getPost('harga');
        $jumlah     = $this->request->getPost('jumlah');

        $dataForm = [
            'nama'       => $nama,
            'harga_beli' => $harga_beli,
            'harga'      => $harga,
            'jumlah'     => $jumlah
        ];

        if ($dataFoto->isValid() && !$dataFoto->hasMoved()) {
            $fileName = $dataFoto->getRandomName();
            $dataFoto->move('img/', $fileName);
            $dataForm['foto'] = $fileName;
        }

        // 3. Simpan produk
        $this->productModel->insert($dataForm);

        // 4. OTOMATISASI ARUS KAS
        $total_pengeluaran = $harga_beli * $jumlah;
        
        $this->arusKasModel->insert([
            'tanggal'    => date('Y-m-d'),
            'keterangan' => 'Pembelian Stok: ' . $nama . ' (' . $jumlah . ' Pcs)',
            'tipe'       => 'Keluar',
            'nominal'    => $total_pengeluaran
        ]);

        return redirect('produk')->with('success', 'Data Berhasil Ditambah & Kas Keluar Tercatat');
    }

    public function edit($id)
    {
        $dataProduk = $this->productModel->find($id);

        $dataForm = [
            'nama'       => $this->request->getPost('nama'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga'      => $this->request->getPost('harga'),
            'jumlah'     => $this->request->getPost('jumlah')
        ];

        if ($this->request->getPost('check') == 1) {
            if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
                unlink("img/" . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->productModel->update($id, $dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect('produk')->with('success', 'Data Berhasil Dihapus');
    }

    public function download()
    {
        $products = $this->productModel->findAll();
        $html = view('produk/download_pdf', ['products' => $products]);
        $filename = date('Y-m-d-H-i-s') . '-produk.pdf';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => true]);
    }
}