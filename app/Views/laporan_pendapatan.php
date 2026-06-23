<?php
helper('number');
?>
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Font Global & Latar Belakang */
    body, .main, #main {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f4f9ff !important; /* Latar belakang biru pastel lembut */
        color: #455a64 !important;
    }

    /* Kustomisasi Teks Judul & Garis Pembatas */
    h3 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }
    hr {
        border-color: #bbdefb !important;
        opacity: 0.7 !important;
    }

    /* Kustomisasi Form Input */
    .form-control {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
    }
    .form-control:focus {
        border-color: #64b5f6 !important;
        box-shadow: 0 0 0 0.25rem rgba(100, 181, 246, 0.25) !important;
    }
    .form-label {
        color: #546e7a !important;
        font-weight: 500 !important;
    }

    /* Kustomisasi Tombol (Buttons) */
    .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
        border: none !important;
        padding: 8px 16px !important;
    }
    /* Tombol Tampilkan (Primary pastel) */
    .btn-primary { background-color: #64b5f6 !important; color: #fff !important; }
    .btn-primary:hover { background-color: #42a5f5 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(100,181,246,0.3) !important; }
    
    /* Tombol Cetak PDF (Danger pastel) */
    .btn-danger { background-color: #e57373 !important; color: #fff !important; }
    .btn-danger:hover { background-color: #ef5350 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(229,115,115,0.3) !important; }
    
    /* Tombol Export Excel (Success pastel) */
    .btn-success { background-color: #81c784 !important; color: #fff !important; }
    .btn-success:hover { background-color: #66bb6a !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(129,199,132,0.3) !important; }

    /* Kustomisasi Wadah Tabel */
    .table-responsive {
        background-color: #ffffff !important;
        border-radius: 12px !important;
        padding: 20px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
        margin-top: 1rem;
    }

    /* Kustomisasi Tabel dengan Garis Biru Tua */
    .table {
        border-collapse: collapse !important;
        width: 100%;
        margin-bottom: 0 !important;
    }
    .table-bordered, 
    .table-bordered th, 
    .table-bordered td {
        border: 1px solid #1565c0 !important; /* Garis warna biru tua */
    }
    .table thead th {
        background-color: #e3f2fd !important; /* Header biru pastel */
        color: #1565c0 !important;
        font-weight: 600 !important;
        padding: 12px 15px !important;
    }
    .table tbody td {
        color: #546e7a !important;
        padding: 12px 15px !important;
        vertical-align: middle !important;
    }
    .table tbody tr:hover td {
        background-color: #f4f9ff !important; /* Hover biru pastel muda */
    }

    /* Menjaga Warna Nominal Sisa Piutang & Terbayar */
    .text-success, .table tbody td.text-success { color: #66bb6a !important; }
    .text-danger, .table tbody td.text-danger { color: #ef5350 !important; }

    /* Kustomisasi Badges Status */
    .badge {
        padding: 0.55em 0.8em !important;
        border-radius: 12px !important;
        font-weight: 500 !important;
    }
    .bg-success { background-color: #e8f5e9 !important; color: #2e7d32 !important; border: 1px solid #c8e6c9 !important; }
    .bg-warning { background-color: #fff8e1 !important; color: #f57f17 !important; border: 1px solid #ffecb3 !important; }
    .bg-danger { background-color: #ffebee !important; color: #c62828 !important; border: 1px solid #ffcdd2 !important; }

    /* Kustomisasi Baris Total Akumulasi */
    .table-warning, .table-warning td {
        background-color: #fffde7 !important; /* Kuning pastel */
        color: #455a64 !important;
        font-weight: bold !important;
    }
</style>

<!-- <h3>Laporan Pendapatan</h3> -->
<hr>
<form action="<?= base_url('laporan_pendapatan') ?>" method="get" class="row g-3 mb-4">
    <div class="col-md-3">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= esc($tanggal_awal ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= esc($tanggal_akhir ?? '') ?>">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i> Tampilkan</button>
    </div>
    <div class="col-md-3 align-self-end text-end">
        <?php if (!empty($laporan)) : ?>
            <a href="<?= base_url("laporan/exportPdf?tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir") ?>" target="_blank" class="btn btn-danger"><i class="bi bi-file-pdf me-1"></i> Cetak PDF</a>
            <a href="<?= base_url("laporan/exportExcel?tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir") ?>" target="_blank" class="btn btn-success"><i class="bi bi-file-excel me-1"></i> Export Excel</a>
        <?php endif; ?>
    </div>
</form>

<?php if (!empty($laporan)) : ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>User</th>
                    <th>Total Omset</th>
                    <th>Terbayar</th>
                    <th>Sisa Piutang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Siapkan variabel untuk menampung grand total
                $total_tagihan = 0;
                $total_terbayar = 0;
                $total_sisa = 0;

                foreach ($laporan as $i => $row) :
                    // Pastikan variabel sudah_dibayar tidak null (fallback ke 0)
                    $terbayar = $row['sudah_dibayar'] ?? 0;
                    $sisa_piutang = $row['total_harga'] - $terbayar;

                    // Akumulasi total
                    $total_tagihan += $row['total_harga'];
                    $total_terbayar += $terbayar;
                    $total_sisa += $sisa_piutang;
                ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td class="text-center fw-bold text-secondary">#<?= esc($row['id']) ?></td>
                        <td class="text-center"><?= esc($row['created_at']) ?></td>
                        <td><?= esc($row['username']) ?></td>
                        <td class="text-end fw-bold"><?= number_to_currency($row['total_harga'], 'IDR') ?></td>
                        <td class="text-end text-success fw-bold"><?= number_to_currency($terbayar, 'IDR') ?></td>
                        <td class="text-end text-danger fw-bold"><?= number_to_currency($sisa_piutang, 'IDR') ?></td>
                        <td class="text-center">
                            <?php if ($sisa_piutang <= 0): ?>
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Lunas</span>
                            <?php elseif ($terbayar > 0 && $sisa_piutang > 0): ?>
                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Belum Lunas</span>
                            <?php else: ?>
                                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Belum Bayar</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr class="table-warning">
                    <td colspan="4" class="text-center text-uppercase">Total Akumulasi Pendapatan</td>
                    <td class="text-end"><?= number_to_currency($total_tagihan, 'IDR') ?></td>
                    <td class="text-end text-success"><?= number_to_currency($total_terbayar, 'IDR') ?></td>
                    <td class="text-end text-danger"><?= number_to_currency($total_sisa, 'IDR') ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>