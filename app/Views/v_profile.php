<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Font Global & Latar Belakang */
    body,
    .main,
    #main {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f4f9ff !important;
        /* Latar belakang biru pastel sangat lembut */
        color: #455a64 !important;
    }

    /* Kustomisasi Teks Judul */
    strong {
        color: #1e88e5 !important;
    }

    hr {
        border-color: #bbdefb !important;
        opacity: 0.7 !important;
    }

    /* Kustomisasi Wadah Tabel (Card Look) */
    .table-responsive {
        background-color: #ffffff !important;
        border-radius: 12px !important;
        padding: 20px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
        margin-top: 1rem;
    }

    /* Kustomisasi Tabel - Disesuaikan agar sama dengan halaman Produk */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: none !important;
    }

    /* Header Tabel (Kotak Biru Membulat) */
    .table thead th {
        background-color: #eaf3ff !important;
        /* Header tabel biru pastel terang */
        color: #1565c0 !important;
        font-weight: 600 !important;
        border: none !important;
        /* Menghilangkan garis pembatas agar terlihat seperti blok utuh */
        padding: 15px !important;
        vertical-align: middle;
    }

    /* Melengkungkan ujung kiri header */
    .table thead th:first-child {
        border-top-left-radius: 10px !important;
        border-bottom-left-radius: 10px !important;
    }

    /* Melengkungkan ujung kanan header */
    .table thead th:last-child {
        border-top-right-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }

    .table tbody td,
    .table tbody th {
        vertical-align: middle !important;
        color: #546e7a !important;
        border-bottom: 1px solid #f0f8ff !important;
        padding: 12px 15px !important;
    }

    .table tbody tr:hover td,
    .table tbody tr:hover th {
        background-color: #f4f9ff !important;
        /* Efek hover baris biru muda */
    }

    /* Kustomisasi Input Form DataTables (Search & Entries) */
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        padding: 5px 10px !important;
        color: #455a64 !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #64b5f6 !important;
        outline: none !important;
        box-shadow: 0 0 0 0.2rem rgba(100, 181, 246, 0.25) !important;
    }

    /* Kustomisasi Tombol (Buttons) */
    .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        padding: 6px 14px !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }

    /* Tombol Detail (Success) */
    .btn-success {
        background-color: #81c784 !important;
        /* Hijau pastel */
        color: #ffffff !important;
    }

    .btn-success:hover {
        background-color: #66bb6a !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(129, 199, 132, 0.3) !important;
    }

    /* Tombol Upload Bukti (Warning) */
    .btn-warning {
        background-color: #ffb74d !important;
        /* Oranye pastel */
        color: #ffffff !important;
    }

    .btn-warning:hover {
        background-color: #ffa726 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 183, 77, 0.3) !important;
    }

    /* Tombol Kirim di Modal (Primary) */
    .btn-primary {
        background-color: #64b5f6 !important;
        /* Biru pastel */
        color: #ffffff !important;
    }

    .btn-primary:hover {
        background-color: #42a5f5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(100, 181, 246, 0.3) !important;
    }

    /* Kustomisasi Modal */
    .modal-content {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(100, 181, 246, 0.25) !important;
    }

    .modal-header {
        border-bottom: 1px solid #e3f2fd !important;
        background-color: #ffffff !important;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    .modal-title {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }

    .modal-footer {
        border-top: 1px solid #e3f2fd !important;
    }

    /* Kustomisasi Input File di dalam Modal */
    .modal-body .form-control {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
    }

    .modal-body .form-control:focus {
        border-color: #64b5f6 !important;
        box-shadow: 0 0 0 0.25rem rgba(100, 181, 246, 0.25) !important;
    }

    /* --- Kustomisasi Item di Modal Detail --- */
    .detail-item-card {
        background-color: #ffffff;
        border: 1px solid #e3f2fd !important;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .detail-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(100, 181, 246, 0.15);
    }

    .detail-item-img {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #f0f8ff;
    }

    .detail-item-title {
        color: #1e88e5;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }

    .detail-item-price {
        color: #78909c;
        font-size: 0.85rem;
    }

    .detail-item-subtotal {
        color: #455a64;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .detail-summary-box {
        background-color: #eaf3ff;
        border-radius: 12px;
        padding: 12px 16px;
        margin-top: 15px;
        border: 1px dashed #90caf9;
    }
</style>

History Transaksi Pembelian <strong><?= $username ?></strong>
<hr>
<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Pembelian</th>
                <th scope="col">Waktu Pembelian</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Alamat</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($buy)) :
                foreach ($buy as $index => $item) :
            ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1 ?></th>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['created_at'] ?></td>
                        <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?php echo $item['alamat'] ?></td>
                        <td><?php echo [
                                0 => 'Menunggu Pembayaran',
                                1 => 'Sudah Dibayar',
                                2 => 'Sedang Dikirim',
                                3 => 'Sudah Selesai',
                                4 => 'Dibatalkan'
                            ][$item['status']] ?? 'Status Tidak Diketahui' ?>
                        </td>
                        <td>
                            <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if (!empty($product)) : ?>
                                                <div class="detail-items-wrapper">
                                                    <?php foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                                        <div class="detail-item-card d-flex align-items-center">

                                                            <div class="me-3">
                                                                <?php if ($item2['foto'] != '' and file_exists("img/" . $item2['foto'])) : ?>
                                                                    <img src="<?= base_url() . "img/" . $item2['foto'] ?>" class="detail-item-img" alt="Produk">
                                                                <?php else: ?>
                                                                    <div class="detail-item-img d-flex align-items-center justify-content-center" style="background: #f4f9ff; color: #90caf9; font-size: 0.8rem;">No Image</div>
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="flex-grow-1">
                                                                <div class="detail-item-title">
                                                                    <?= $item2['nama'] ?>
                                                                </div>
                                                                <div class="d-flex justify-content-between align-items-center mt-1">
                                                                    <div class="detail-item-price">
                                                                        <?= number_to_currency($item2['harga'], 'IDR') ?> <span class="text-muted">x <?= $item2['jumlah'] ?> pcs</span>
                                                                    </div>
                                                                    <div class="detail-item-subtotal">
                                                                        <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="detail-summary-box d-flex justify-content-between align-items-center">
                                                <span style="color: #1565c0; font-weight: 500;">
                                                    <i class="fas fa-truck me-1"></i> Ongkos Kirim
                                                </span>
                                                <strong style="color: #1565c0; font-size: 1.05rem;">
                                                    <?= number_to_currency($item['ongkir'], 'IDR') ?>
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if (!empty($item['bukti_pembayaran'])): ?>
                                <img src="<?= base_url('uploads/bukti/' . $item['bukti_pembayaran'])
                                            ?>" width="150px" alt="Bukti Pembayaran" style="border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#detailModal-<?= $item['id'] ?>"> Detail
                            </button>
                            <?php if ($item['status'] == 0): ?>
                                <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#uploadModal-<?= $item['id'] ?>">
                                    Upload Bukti
                                </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="uploadModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="<?= base_url('upload-bukti') ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_pembelian" value="<?= $item['id'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="bukti" class="form-label">Pilih File Bukti (gambar)</label>
                                            <input class="form-control" type="file" id="bukti" name="bukti" accept="image/*" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
        <?php
                endforeach;
            endif;
        ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>