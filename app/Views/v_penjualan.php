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

    /* Kustomisasi Teks Judul & Garis Pembatas */
    h4 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }
    hr {
        border-color: #bbdefb !important;
        opacity: 0.7 !important;
    }

    /* Kustomisasi Wadah Tabel */
    .table-responsive {
        background-color: #ffffff !important;
        border-radius: 12px !important;
        padding: 20px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
    }

    /* Kustomisasi Tabel Utama */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
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
        background-color: #f4f9ff !important; /* Efek hover baris biru muda */
    }

    /* Kustomisasi Dropdown (Select) Ubah Status */
    .form-select {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
        font-size: 0.875rem !important;
        background-color: #fcfcfc !important;
        transition: all 0.3s ease;
    }
    .form-select:focus {
        border-color: #64b5f6 !important;
        box-shadow: 0 0 0 0.25rem rgba(100, 181, 246, 0.25) !important;
    }

    /* Kustomisasi Tombol Check (Success) */
    .btn-success {
        background-color: #81c784 !important; /* Hijau pastel untuk tombol aksi */
        border-color: #81c784 !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        transition: all 0.3s ease !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-success:hover {
        background-color: #66bb6a !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(129, 199, 132, 0.3) !important;
    }

    /* Kustomisasi Thumbnail Bukti Transfer */
    .img-thumbnail {
        border: 2px solid #bbdefb !important;
        border-radius: 10px !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(100, 181, 246, 0.4) !important;
    }

    /* Kustomisasi Badges Status menjadi Pastel */
    .badge {
        padding: 0.55em 0.8em !important;
        border-radius: 12px !important;
        font-weight: 500 !important;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05) !important;
    }
    .bg-danger { background-color: #ffebee !important; color: #c62828 !important; border: 1px solid #ffcdd2 !important;} /* Merah pastel */
    .bg-warning { background-color: #fff8e1 !important; color: #f57f17 !important; border: 1px solid #ffecb3 !important;} /* Kuning pastel */
    .bg-info { background-color: #e1f5fe !important; color: #0277bd !important; border: 1px solid #b3e5fc !important;} /* Biru cyan pastel */
    .bg-success { background-color: #e8f5e9 !important; color: #2e7d32 !important; border: 1px solid #c8e6c9 !important;} /* Hijau pastel */
    .bg-dark { background-color: #eceff1 !important; color: #37474f !important; border: 1px solid #cfd8dc !important;} /* Abu-abu pastel */
    .bg-secondary { background-color: #f5f5f5 !important; color: #757575 !important; border: 1px solid #e0e0e0 !important;}

    /* Kustomisasi DataTables Controls (Search & Entries) */
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Daftar Transaksi Penjualan</h4>
</div>
<hr>

<?= session()->getFlashdata('success') ?>
<?= session()->getFlashdata('error') ?>

<div class="table-responsive">
    <table class="table datatable align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">UserName</th>
                <th scope="col">Total Harga</th>
                <!-- <th scope="col">Alamat</th> -->
                <th scope="col">Ongkir</th>
                <th scope="col" class="text-center">Bukti Transfer</th>
                <th scope="col">Status</th>
                <th scope="col">Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if  (!empty($transactions)) :
                foreach ($transactions as $index => $item) :
            ?>
                <tr>
                    <th scope="row"> <?= $index + 1 ?></th>
                    <td class="fw-bold text-secondary">#<?= $item['id'] ?></td>
                    <td><?= $item['username'] ?></td>
                    <td class="fw-bold"><?= number_to_currency($item['total_harga'],'IDR') ?></td>
                    <!-- <td><?= $item['alamat'] ?></td> -->
                    <td><?= number_to_currency($item['ongkir'],'IDR') ?></td>
                    
                    <td class="text-center">
                        <?php if (!empty($item['bukti_pembayaran'])) : ?>
                            <a href="<?= base_url('uploads/bukti/' . $item['bukti_pembayaran']) ?>" target="_blank" title="Klik untuk perbesar">
    <img src="<?= base_url('uploads/bukti/' . $item['bukti_pembayaran']) ?>" alt="Bukti Pembayaran" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
</a>
                        <?php else : ?>
                            <span class="badge bg-secondary" style="font-size: 0.75rem;">Belum Upload</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php 
                        $statusText = [
                            0 => '<span class="badge bg-danger">Menunggu Pembayaran</span>',
                            1 => '<span class="badge bg-warning text-dark">Bukti Diterima</span>',
                            2 => '<span class="badge bg-info">Sedang Dikirim</span>',
                            3 => '<span class="badge bg-success">Sudah Selesai</span>',
                            4 => '<span class="badge bg-dark">Dibatalkan</span>',
                        ];
                        echo $statusText[$item['status']] ?? '<span class="badge bg-secondary">Tidak Diketahui</span>';
                        ?>
                    </td>
                    
                    <td>
                        <form action="<?= base_url('penjualan/updateStatus/' . $item['id']) ?>" method="post" class="d-flex align-items-center gap-2">
                            <?= csrf_field() ?>    
                            <select name="status" class="form-select form-select-sm" style="min-width: 160px;">
                                <option value="0" <?= $item['status'] == "0" ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                                <option value="1" <?= $item['status'] == "1" ? 'selected' : '' ?>>Bukti Diterima</option>
                                <option value="2" <?= $item['status'] == "2" ? 'selected' : '' ?>>Sedang Dikirim</option>
                                <option value="3" <?= $item['status'] == "3" ? 'selected' : '' ?>>Sudah Selesai</option>
                                <option value="4" <?= $item['status'] == "4" ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i></button>
                        </form>
                    </td>
                </tr>
            <?php 
                endforeach;
            endif;
            ?>            
        </tbody>
    </table>
    </div>
<?= $this->endSection() ?>