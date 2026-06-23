<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Font Global & Latar Belakang */
    body, .main, #main, .pagetitle {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f4f9ff !important; /* Latar belakang biru pastel lembut */
        color: #455a64 !important;
    }

    /* Kustomisasi Teks Judul & Breadcrumb */
    .pagetitle h1 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }
    .breadcrumb-item a {
        color: #64b5f6 !important;
    }
    .card-title {
        color: #1565c0 !important;
        font-weight: 600 !important;
    }

    /* Kustomisasi Card */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
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

    /* Kustomisasi Tombol (Buttons) */
    .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }
    /* Tombol Tampilkan (Primary pastel) */
    .btn-primary { background-color: #64b5f6 !important; color: #fff !important; }
    .btn-primary:hover { background-color: #42a5f5 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(100,181,246,0.3) !important; }
    
    /* Tombol Cetak PDF (Danger pastel) */
    .btn-danger { background-color: #e57373 !important; color: #fff !important; }
    .btn-danger:hover { background-color: #ef5350 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(229,115,115,0.3) !important; }

    /* Kustomisasi Tabel dengan Garis Biru Tua */
    .table {
        border-collapse: collapse !important; 
        width: 100%;
    }
    .table-bordered, 
    .table-bordered th, 
    .table-bordered td {
        border: 1px solid #1565c0 !important; /* Warna biru tua untuk semua sekat tabel */
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
    
    /* Mempertahankan Warna Nominal (Hijau & Merah) */
    .table tbody td.text-success, .text-success {
        color: #66bb6a !important; /* Hijau pastel tegas */
    }
    .table tbody td.text-danger, .text-danger {
        color: #ef5350 !important; /* Merah pastel tegas */
    }

    /* Penyesuaian baris tabel */
    .bg-light { background-color: #f0f8ff !important; } /* Laba Kotor */
    
 /* Kustomisasi Teks Judul & Garis Pembatas */
    h4 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }
    hr {
        border-color: #bbdefb !important;
        opacity: 0.7 !important;
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Laporan Laba Rugi</h4>
</div>
<hr>

<div class="pagetitle">
    <!-- <h1>Laporan Laba Rugi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
            <li class="breadcrumb-item active">Laporan Laba Rugi</li>
        </ol>
    </nav> -->
</div>

<section class="section">
    <form action="<?= base_url('laporan_laba_rugi') ?>" method="get" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="tanggal_awal" class="form-label text-muted small fw-bold">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= esc($tanggal_awal ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label for="tanggal_akhir" class="form-label text-muted small fw-bold">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= esc($tanggal_akhir ?? '') ?>">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i> Tampilkan</button>
        </div>
        <div class="col-md-3 align-self-end text-end">
            <a href="<?= base_url('laporan_laba_rugi/exportPdf?tanggal_awal=' . ($tanggal_awal ?? '') . '&tanggal_akhir=' . ($tanggal_akhir ?? '')) ?>" target="_blank" class="btn btn-danger">
                <i class="bi bi-file-pdf me-1"></i> Cetak PDF
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-body pt-4">
            <h5 class="card-title p-0 m-0 text-center mb-4">Laporan Laba Rugi <br> <span class="fs-6 text-muted fw-normal">Periode: <?= ($tanggal_awal && $tanggal_akhir) ? date('d M Y', strtotime($tanggal_awal)) . ' - ' . date('d M Y', strtotime($tanggal_akhir)) : 'Semua Waktu' ?></span></h5>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" style="width: 60%;">Keterangan</th>
                                <th scope="col" style="width: 40%;">Nilai (IDR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Pendapatan</strong> <br> <span class="ms-3">Penjualan</span></td>
                                <td class="text-end text-success align-middle"><?= number_format($penjualan, 0, ',', '.') ?></td>
                            </tr>

                            <tr>
                                <td><strong>Harga Pokok Penjualan (HPP)</strong> </td>
                                <td class="text-end text-danger align-middle">( <?= number_format($hpp, 0, ',', '.') ?> )</td>
                            </tr>

                            <tr class="bg-light">
                                <td class="fw-bold fs-6">Laba Kotor</td>
                                <td class="text-end fw-bold fs-6 <?= ($laba_kotor >= 0) ? 'text-success' : 'text-danger' ?>"><?= number_format($laba_kotor, 0, ',', '.') ?></td>
                            </tr>

                            <tr>
                                <td><strong>Beban</strong> <br> <span class="ms-3">Ongkir, Iklan, Operasional, dll</span></td>
                                <td class="text-end text-danger align-middle">( <?= number_format($beban, 0, ',', '.') ?> )</td>
                            </tr>

                            <tr style="background-color: #fffde7;"> <td class="fw-bold fs-5 text-uppercase" style="color: #455a64 !important;">Laba Bersih</td>
                                <td class="text-end fw-bold fs-5 <?= ($laba_bersih >= 0) ? 'text-success' : 'text-danger' ?>"><?= number_format($laba_bersih, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3 text-muted small">
                        <strong>Rumus:</strong><br>
                        Laba Kotor = Penjualan - HPP <br>
                        Laba Bersih = Laba Kotor - Beban
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>