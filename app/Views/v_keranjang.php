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

    /* Kustomisasi Judul Halaman (Jika ada) */
    h1, h2, h3, h4, h5, h6, .pagetitle h1 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }

    /* Kustomisasi Tabel Keranjang */
    .table {
        background-color: #ffffff !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 1.5rem !important;
    }
    .table thead th {
        background-color: #e3f2fd !important; /* Header tabel biru pastel */
        color: #1565c0 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid #bbdefb !important;
        padding: 15px !important;
        border-top: none !important;
    }
    .table tbody td {
        vertical-align: middle !important;
        color: #546e7a !important;
        border-bottom: 1px solid #f0f8ff !important;
        padding: 12px 15px !important;
    }
    .table tbody tr:hover td {
        background-color: #f4f9ff !important; /* Efek hover baris biru sangat cerah */
    }

    /* Kustomisasi Form Input (Jumlah/Qty) */
    .form-control {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
        text-align: center;
    }
    .form-control:focus {
        border-color: #64b5f6 !important;
        box-shadow: 0 0 0 0.25rem rgba(100, 181, 246, 0.25) !important;
    }

    /* Kustomisasi Alert Info (Total Harga) */
    .alert-info {
        background-color: #e3f2fd !important;
        color: #1565c0 !important;
        border: 1px solid #bbdefb !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-size: 1.1rem !important;
        box-shadow: 0 4px 10px rgba(100, 181, 246, 0.1) !important;
    }

    /* Kustomisasi Alert Success (Notifikasi Hapus/Tambah) */
    .alert-success {
        background-color: #d4edda !important; /* Hijau pastel */
        color: #155724 !important;
        border: 1px solid #c3e6cb !important;
        border-radius: 12px !important;
    }

    /* Kustomisasi Tombol (Buttons) */
    .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        padding: 8px 16px !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }
    
    /* Tombol Perbarui (Primary) */
    .btn-primary {
        background-color: #64b5f6 !important; /* Biru pastel */
        color: #ffffff !important;
    }
    .btn-primary:hover {
        background-color: #42a5f5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(100, 181, 246, 0.3) !important;
    }

    /* Tombol Kosongkan (Warning) */
    .btn-warning {
        background-color: #ffb74d !important; /* Oranye/kuning pastel */
        color: #ffffff !important;
    }
    .btn-warning:hover {
        background-color: #ffa726 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 183, 77, 0.3) !important;
    }

    /* Tombol Selesai Belanja (Success) */
    .btn-success {
        background-color: #81c784 !important; /* Hijau pastel */
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
        padding: 6px 12px !important;
    }
    .btn-danger:hover {
        background-color: #ef5350 !important;
        transform: scale(1.05);
    }
</style>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<?= form_open('keranjang/edit') ?>
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($items)) :
            foreach ($items as $index => $item) :
        ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><img src="<?= base_url() . "img/" . $item['options']['foto'] ?>" width="100px" style="border-radius: 8px;"></td>
                    <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                    <td><input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= $item['qty'] ?>"></td>
                    <td><?= number_to_currency($item['subtotal'], 'IDR') ?></td>
                    <td>
                        <a href="<?= base_url('keranjang/delete/' . $item['rowid'] . '') ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>

<div class="alert alert-info">
    <?= "Total = " . number_to_currency($total, 'IDR') ?>
</div>

<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
<a class="btn btn-warning" href="<?= base_url() ?>keranjang/clear">Kosongkan Keranjang</a>
<?php if (!empty($items)) : ?>
    <a class="btn btn-success" href="<?php echo base_url()?>checkout">Selesai Belanja</a>
<?php endif; ?>
<?= form_close() ?>
<?= $this->endSection() ?>