<?php

namespace App\Controllers;

use App\Models\ProductModel; 

class Home extends BaseController
{
    protected $productModel;

    function __construct(){
    $this->productModel = new ProductModel();
}
     public function index()
    {
        helper(['number', 'form']);

        // 2. Ambil data produk dari database (sesuaikan dengan kode Anda yang sudah ada)
        $data = [
            'products' => $this->productModel->findAll(),
        ];

        // 3. Tampilkan ke halaman view
        return view('v_home', $data);
    }
}