<?php

namespace App\Models;
use CodeIgniter\Model;

class LaporanModel extends Model
{
    public function getProdukTerlaris($tanggal_awal = null, $tanggal_akhir = null)
    {
        $builder = $this->db->table('transaction_detail');        
        // Pilih kolom yang diperlukan dan jumlahkan kuantitas serta harga
        $builder->select('
            product.id as id_produk, 
            product.nama as nama_produk, 
            SUM(transaction_detail.jumlah) as jumlah_terjual, 
            SUM(transaction_detail.subtotal_harga) as total_harga
        ');
        $builder->join('product', 'product.id = transaction_detail.product_id');
        $builder->join('transaction', 'transaction.id = transaction_detail.transaction_id');
        // Filter status transaksi sukses
        $builder->whereIn('transaction.status', [1, 2]); 
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $builder->where('DATE(transaction.created_at) >=', $tanggal_awal);
            $builder->where('DATE(transaction.created_at) <=', $tanggal_akhir);
        }
        // Kelompokkan data per produk agar tidak ada baris ganda
        $builder->groupBy('product.id'); 
        // Urutkan dari jumlah terjual paling banyak
        $builder->orderBy('jumlah_terjual', 'DESC'); 
        return $builder->get()->getResultArray();
    }

    public function getDaftarPiutang()
    {
        $builder = $this->db->table('transaction');
        
        $builder->select('
            id as invoice, 
            username as pelanggan, 
            total_harga as total_tagihan, 
            sudah_dibayar,
            (total_harga - sudah_dibayar) as sisa_piutang
        ');
        
        $builder->orderBy('created_at', 'DESC');
        return $builder->get()->getResultArray();
    }
}