<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Font Global & Latar Belakang */
    body, .main, #main {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f4f9ff !important; /* Latar belakang biru pastel sangat lembut */
        color: #455a64 !important;
    }

    /* Kustomisasi Judul/Teks */
    h1, h2, h3, h4, h5, h6, .pagetitle h1 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }

    /* Kustomisasi Tombol (Buttons) */
    .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        padding: 8px 16px !important;
        transition: all 0.3s ease !important;
        border: none !important;
        margin-bottom: 1rem !important; /* Memberi jarak bawah pada tombol atas tabel */
    }
    
    /* Tombol Tambah Data (Primary) */
    .btn-primary {
        background-color: #64b5f6 !important; /* Biru pastel */
        color: #ffffff !important;
    }
    .btn-primary:hover {
        background-color: #42a5f5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(100, 181, 246, 0.3) !important;
    }

    /* Tombol Download & Ubah (Success) */
    .btn-success {
        background-color: #81c784 !important; /* Hijau pastel agar tetap sesuai konteks 'success' */
        color: #ffffff !important;
    }
    .btn-success:hover {
        background-color: #66bb6a !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(129, 199, 132, 0.3) !important;
    }

    /* Tombol Hapus (Danger) */
    .btn-danger {
        background-color: #e57373 !important; /* Merah pastel */
        color: #ffffff !important;
    }
    .btn-danger:hover {
        background-color: #ef5350 !important;
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(229, 115, 115, 0.3) !important;
    }

    /* Kustomisasi Tabel Produk */
    .table {
        background-color: #ffffff !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 1rem !important;
    }
    .table thead th {
        background-color: #e3f2fd !important; /* Header tabel biru pastel */
        color: #1565c0 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid #bbdefb !important;
        padding: 15px !important;
        border-top: none !important;
        vertical-align: middle;
    }
    .table tbody td, .table tbody th {
        vertical-align: middle !important;
        color: #546e7a !important;
        border-bottom: 1px solid #f0f8ff !important;
        padding: 12px 15px !important;
    }
    .table tbody tr:hover td, .table tbody tr:hover th {
        background-color: #f4f9ff !important; /* Efek hover baris tabel biru muda */
    }

    /* Kustomisasi Gambar di dalam Tabel */
    .table tbody td img {
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .table tbody td img:hover {
        transform: scale(1.05);
    }

    /* Kustomisasi Alert (Notifikasi) */
    .alert-info {
        background-color: #e3f2fd !important;
        color: #1565c0 !important;
        border: 1px solid #bbdefb !important;
        border-radius: 12px !important;
    }
    .alert-danger {
        background-color: #ffebee !important;
        color: #c62828 !important;
        border: 1px solid #ffcdd2 !important;
        border-radius: 12px !important;
    }

    /* Kustomisasi Input Form DataTables (Search & Entries) */
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #bbdefb !important;
        border-radius: 6px !important;
        padding: 4px 8px !important;
        color: #455a64 !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #64b5f6 !important;
        outline: none !important;
        box-shadow: 0 0 0 0.2rem rgba(100, 181, 246, 0.25) !important;
    }
</style>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>
<a class="btn btn-success" target="_blank" href="<?= base_url()?>produk/download">
    Download Data
</a>

<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Foto</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $index => $produk) : ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= $produk['nama'] ?></td>
                
                <td>Rp <?= number_format($produk['harga_beli'], 0, ',', '.') ?></td>
                
                <td>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
                
                <td><?= $produk['jumlah'] ?></td>
                <td>
                    <?php if ($produk['foto'] != '' and file_exists("img/" . $produk['foto'] . "")) : ?>
                        <img src="<?= base_url() . "img/" . $produk['foto'] ?>" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->include('produk/modal_add') ?>
<?= $this->include('produk/modal_edit') ?>
<?= $this->endSection() ?>