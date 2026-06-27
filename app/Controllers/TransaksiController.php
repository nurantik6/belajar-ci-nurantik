<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniterCart\Cart;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ProductModel;

class TransaksiController extends BaseController
{
    protected $cart;
    protected $client;
    protected $apiKey;
    protected $transaction;
    protected $transaction_detail;
    protected $product;

    function __construct()
    {
        helper('number');
        helper('form');
        $this->cart = \Config\Services::cart();
        $this->client = new \GuzzleHttp\Client();
        $this->apiKey = env('COST_KEY');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
        $this->product = new ProductModel();
    }

    public function index()
    {
        $data = [
            'items' => $this->cart->contents(),
            'total' => $this->cart->total()
        ];
        return view('v_keranjang', $data);
    }

    public function cart_add()
    {
        $idProduk = $this->request->getPost('id');
        $qtyDitambah = 1; // Asumsi penambahan default adalah 1

        // Cek apakah produk sudah ada di keranjang untuk menjumlahkan qty-nya
        $cartContents = $this->cart->contents();
        $qtyDiKeranjang = 0;
        foreach ($cartContents as $item) {
            if ($item['id'] == $idProduk) {
                $qtyDiKeranjang = $item['qty'];
                break;
            }
        }

        $totalQtyDiminta = $qtyDiKeranjang + $qtyDitambah;

        // Ambil data produk dari database
        $produk = $this->product->find($idProduk);

        // Validasi ketersediaan stok
        if (!$produk || $totalQtyDiminta > $produk['jumlah']) {
            session()->setFlashdata(
                'error', 
                'Gagal menambahkan! Sisa stok ' . $produk['nama'] . ' hanya ' . $produk['jumlah'] . ' pcs.'
            );
            return redirect()->to(base_url('/'));
        }

        // Jika stok aman, lanjutkan insert ke keranjang
        $this->cart->insert([
            'id'      => $idProduk,
            'qty'     => $qtyDitambah,
            'price'   => $this->request->getPost('harga'),
            'name'    => $this->request->getPost('nama'),
            'options' => [
                'foto' => $this->request->getPost('foto')
            ]
        ]);

        session()->setFlashdata(
            'success',
            'Produk berhasil ditambahkan ke keranjang. <a href="' . base_url('keranjang') . '">Lihat</a>'
        );
        return redirect()->to(base_url('/'));
    }

    public function cart_edit()
    {
        $i = 1;
        $adaError = false;

        foreach ($this->cart->contents() as $item) {
            $qtyBaru = $this->request->getPost('qty' . $i++);
            
            // Ambil data produk dari database untuk cek stok
            $produk = $this->product->find($item['id']);

            // Validasi jika input qty melebihi stok di database
            if ($produk && $qtyBaru > $produk['jumlah']) {
                session()->setFlashdata(
                    'error', 
                    'Stok ' . $produk['nama'] . ' tidak mencukupi. Maksimal pembelian: ' . $produk['jumlah']
                );
                $adaError = true;
                
                // Kembalikan qty ke maksimal stok yang tersedia (Opsional)
                // $qtyBaru = $produk['jumlah']; 
                
                // Lewati update untuk item ini jika melebihi stok
                continue; 
            }

            // Jika aman, update keranjang
            $this->cart->update([
                'rowid' => $item['rowid'],
                'qty'   => $qtyBaru
            ]);
        }

        if (!$adaError) {
            session()->setFlashdata('success', 'Keranjang berhasil diperbarui');
        }
        
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);

        session()->setFlashdata(
            'success',
            'Produk berhasil dihapus dari keranjang'
        );
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();

        session()->setFlashdata(
            'success',
            'Keranjang berhasil dikosongkan'
        );
        return redirect()->to(base_url('keranjang'));
    }

    public function checkout()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_checkout', $data);
    }

    public function buy()
    {
        if ($this->request->getPost()) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'total_harga' => $this->request->getPost('total_harga'),
                'alamat' => $this->request->getPost('alamat'),
                'ongkir' => $this->request->getPost('ongkir'),
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->transaction->insert($dataForm);
            $last_insert_id = $this->transaction->getInsertID();
            
            foreach ($this->cart->contents() as $value) {
                $dataFormDetail = [
                    'transaction_id' => $last_insert_id,
                    'product_id' => $value['id'],
                    'jumlah' => $value['qty'],
                    'diskon' => 0,
                    'subtotal_harga' => $value['qty'] * $value['price'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                $this->transaction_detail->insert($dataFormDetail);
                
                $produk = $this->product->find($value['id']);
                if ($produk) {
                    $sisaStok = $produk['jumlah'] - $value['qty']; 
                
                    $this->product->update($value['id'], [
                        'jumlah' => $sisaStok
                    ]);
                }
                }
            $this->cart->destroy();
            return redirect()->to(base_url());
        }
    }

    public function getLocation()
    {
        //keyword pencarian yang dikirimkan dari halaman checkout
        $search = $this->request->getGet('search');
        $response = $this->client->request(
            'GET',
            'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=' . $search . '&limit=50',
            [
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->apiKey,
                ],
            ]
        );
        $body = json_decode($response->getBody(), true);
        return $this->response->setJSON($body['data']);
    }

    public function getCost()
    {
        //ID lokasi yang dikirimkan dari halaman checkout
        $destination = $this->request->getGet('destination');
        //parameter daerah asal pengiriman, berat produk, dan kurir dibuat statis
        //valuenya => 64999 : PEDURUNGAN TENGAH , 1000 gram, dan JNE
        $response = $this->client->request(
            'POST',
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
            [
                'multipart' => [
                    [
                        'name' => 'origin',
                        'contents' => '64999'
                    ],
                    [
                        'name' => 'destination',
                        'contents' => $destination
                    ],
                    [
                        'name' => 'weight',
                        'contents' => '1000'
                    ],
                    [
                        'name' => 'courier',
                        'contents' => 'jne'
                    ]
                ],
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->apiKey,
                ],
            ]
        );
        $body = json_decode($response->getBody(), true);
        return $this->response->setJSON($body['data']);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        if ($this->transaction->updateStatus($id, $status)) {
            return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui status transaksi.');
        }
    }

    public function uploadBukti()
    {
        $id = $this->request->getPost('id_pembelian');
        $file = $this->request->getFile('bukti');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/bukti/', $newName);
            $this->transaction->update($id, [
                'bukti_pembayaran' => $newName,
                'status' => 1, // Ubah status jadi 'Sudah Dibayar'
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
        }
        return redirect()->back()->with('error', 'Upload bukti gagal.');
    }
}
