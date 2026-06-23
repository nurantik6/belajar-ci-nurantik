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
    hr {
        border-color: #bbdefb !important;
        opacity: 0.7 !important;
    }

    /* Kustomisasi Card */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
    }

    /* Kustomisasi Form Input & Select */
    .form-control, .form-select {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
    }
    .form-control:focus, .form-select:focus {
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
    /* Tombol Simpan (Primary pastel) */
    .btn-primary { background-color: #64b5f6 !important; color: #fff !important; }
    .btn-primary:hover { background-color: #42a5f5 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(100,181,246,0.3) !important; }
    
    /* Tombol Cetak PDF (Danger pastel) */
    .btn-danger { background-color: #e57373 !important; color: #fff !important; }
    .btn-danger:hover { background-color: #ef5350 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(229,115,115,0.3) !important; }
    
    /* Tombol Export Excel (Success pastel) */
    .btn-success { background-color: #81c784 !important; color: #fff !important; }
    .btn-success:hover { background-color: #66bb6a !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(129,199,132,0.3) !important; }

    /* Kustomisasi Tabel */
    .table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: none !important;
    }
    .table thead th {
        background-color: #e3f2fd !important; /* Header biru pastel */
        color: #1565c0 !important;
        font-weight: 600 !important;
        padding: 12px 15px !important;
        border-bottom: 2px solid #bbdefb !important;
    }
    .table tbody td {
        color: #546e7a !important;
        padding: 12px 15px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #e3f2fd !important;
    }
    .table tbody tr:hover td {
        background-color: #f4f9ff !important; /* Hover biru pastel muda */
    }

    /* Mempertahankan dan Memperhalus Warna Nominal (Penting) */
    .table tbody td.text-success, .text-success {
        color: #66bb6a !important; /* Hijau pastel */
    }
    .table tbody td.text-danger, .text-danger {
        color: #ef5350 !important; /* Merah pastel */
    }

    /* Kustomisasi Badge Otomatis */
    .badge.bg-success {
        background-color: #e8f5e9 !important;
        color: #2e7d32 !important;
        border: 1px solid #c8e6c9 !important;
        border-radius: 6px !important;
        padding: 4px 6px !important;
    }

    /* Kustomisasi Alert Notifikasi */
    .alert-success {
        background-color: #e8f5e9 !important; 
        color: #2e7d32 !important; 
        border: 1px solid #c8e6c9 !important; 
        border-radius: 12px !important;
    }

    /* Mengatur warna dasar seluruh sel/garis tabel menjadi biru pastel */
.table-bordered > :not(caption) > * > * {
    border: 1px solid #e3f2fd !important;
}

/* Garis vertikal HIJAU untuk batas kiri kolom 'Masuk' (Kolom ke-2) */
.table tbody td:nth-child(2) {
    border-left: 2px solid #66bb6a !important;
    border-right: none !important; /* Mencegah garis ganda/bertumpuk dengan kolom sebelahnya */
}

/* Garis vertikal MERAH untuk batas kiri dan kanan kolom 'Keluar' (Kolom ke-3) */
.table tbody td:nth-child(3) {
    border-left: 2px solid #ef5350 !important;
    border-right: 2px solid #ef5350 !important;
}
</style>

<div class="pagetitle">
  <!-- <h1>Laporan Arus Kas (Cash Flow)</h1> -->
  <!-- <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
      <li class="breadcrumb-item active">Laporan Arus Kas</li>
    </ol>
  </nav> -->
</div>

<section class="section">
  <?php if(session()->getFlashdata('pesan')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-1"></i>
          <?= session()->getFlashdata('pesan'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body pt-4">
          <h5 class="card-title p-0 m-0 mb-3 text-secondary">Form Pencatatan Kas</h5>
          <hr>
          <form action="<?= base_url('laporan_arus_kas/simpan') ?>" method="POST">
            <div class="mb-3">
              <label class="form-label text-muted small">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label text-muted small">Tipe Arus Kas</label>
              <select class="form-select" name="tipe" required>
                <option value="Keluar">Kas Keluar (Biaya/Gaji/Beli Barang)</option>
                <option value="Masuk">Kas Masuk (Pendapatan Lain-lain)</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label text-muted small">Keterangan</label>
              <input type="text" class="form-control" name="keterangan" placeholder="Contoh: Biaya Operasional Listrik" required>
            </div>
            <div class="mb-4">
              <label class="form-label text-muted small">Nominal (IDR)</label>
              <input type="number" class="form-control" name="nominal" placeholder="Contoh: 2000000" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-1"></i> Simpan Catatan</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card">
        <div class="card-body pt-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title p-0 m-0 text-secondary">Rekapitulasi Arus Kas</h5>
            <div>
              <a href="<?= base_url('laporan_arus_kas/exportPdf') ?>" target="_blank" class="btn btn-danger btn-sm me-1"><i class="bi bi-file-pdf me-1"></i> Cetak PDF</a>
              <a href="<?= base_url('laporan_arus_kas/exportExcel') ?>" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel me-1"></i> Export Excel</a>
            </div>
          </div>
          <hr>

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="table-light text-center">
                <tr>
                  <th scope="col" style="width: 50%;">Keterangan</th>
                  <th scope="col" style="width: 25%;">Masuk</th>
                  <th scope="col" style="width: 25%;">Keluar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $total_masuk = 0;
                  $total_keluar = 0;

                  // 1. Masukkan Penjualan Otomatis di baris pertama
                  $total_masuk += $total_penjualan;
                ?>
                <tr>
                  <td class="fw-bold">Penjualan & Pelunasan Piutang <span class="badge bg-success ms-1" style="font-size: 10px;">Otomatis</span></td>
                  <td class="text-end text-success fw-bold"><?= number_format($total_penjualan, 0, ',', '.') ?></td>
                  <td class="text-center">-</td>
                </tr>

                <?php foreach($arus_kas as $kas): ?>
                  <tr>
                    <td><?= esc($kas['keterangan']) ?> <br><small class="text-muted" style="font-size: 11px;"><?= esc($kas['tanggal']) ?></small></td>
                    <?php if($kas['tipe'] == 'Masuk'): ?>
                        <td class="text-end text-success"><?= number_format($kas['nominal'], 0, ',', '.') ?></td>
                        <td class="text-center">-</td>
                        <?php $total_masuk += $kas['nominal']; ?>
                    <?php else: ?>
                        <td class="text-center">-</td>
                        <td class="text-end text-danger"><?= number_format($kas['nominal'], 0, ',', '.') ?></td>
                        <?php $total_keluar += $kas['nominal']; ?>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>

                <?php 
                  // 3. Kalkulasi Saldo Akhir
                  $saldo_akhir = $total_masuk - $total_keluar;
                ?>
                
                <tr style="background-color: #fffde7; font-weight: bold; font-size: 1.1rem;">
                  <td class="text-center text-uppercase">Saldo Akhir Kas</td>
                  <td colspan="2" class="text-center <?= ($saldo_akhir >= 0) ? 'text-success' : 'text-danger' ?>">
                    IDR <?= number_format($saldo_akhir, 0, ',', '.') ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p class="text-muted small mt-2 mb-0"><strong>Ket:</strong> Saldo Akhir = Saldo Awal + Kas Masuk - Kas Keluar.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>