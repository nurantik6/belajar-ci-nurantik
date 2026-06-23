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

    /* Kustomisasi Card (Wadah Tabel) */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
    }

    /* Kustomisasi Tombol (Buttons) */
    .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }
    /* Tombol Cetak PDF (Danger pastel) */
    .btn-danger { background-color: #e57373 !important; color: #fff !important; }
    .btn-danger:hover { background-color: #ef5350 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(229,115,115,0.3) !important; }
    
    /* Tombol Export Excel (Success pastel) */
    .btn-success { background-color: #81c784 !important; color: #fff !important; }
    .btn-success:hover { background-color: #66bb6a !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(129,199,132,0.3) !important; }
    
    /* Tombol Bayar (Primary pastel) */
    .btn-primary { background-color: #64b5f6 !important; color: #fff !important; }
    .btn-primary:hover { background-color: #42a5f5 !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(100,181,246,0.3) !important; }

    /* Tombol Batal Modal (Secondary pastel) */
    .btn-secondary { background-color: #cfd8dc !important; color: #455a64 !important; }
    .btn-secondary:hover { background-color: #b0bec5 !important; transform: translateY(-2px); }

    /* Kustomisasi Tabel */
    .table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: none !important;
    }
    .table-bordered > :not(caption) > * > * {
        border-width: 0 0 1px 0 !important; /* Menghilangkan border vertikal agar lebih clean */
        border-color: #e3f2fd !important;
    }
    .table thead th {
        background-color: #e3f2fd !important; /* Header biru pastel */
        color: #1565c0 !important;
        font-weight: 600 !important;
        padding: 15px !important;
    }
    .table tbody td {
        color: #546e7a !important;
        padding: 12px 15px !important;
        vertical-align: middle !important;
    }
    .table tbody tr:hover td {
        background-color: #f4f9ff !important; /* Hover biru pastel muda */
    }

    /* Kustomisasi Badges Status */
    .badge {
        padding: 0.55em 0.8em !important;
        border-radius: 12px !important;
        font-weight: 500 !important;
    }
    .bg-warning { background-color: #fff8e1 !important; color: #f57f17 !important; border: 1px solid #ffecb3 !important; }
    .bg-success.badge { background-color: #e8f5e9 !important; color: #2e7d32 !important; border: 1px solid #c8e6c9 !important; }

    /* Kustomisasi Modal Bayar */
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
    .form-control {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
    }
    .form-control:focus {
        border-color: #64b5f6 !important;
        box-shadow: 0 0 0 0.25rem rgba(100, 181, 246, 0.25) !important;
    }
    .form-control:disabled {
        background-color: #f4f9ff !important;
    }

    /* Memaksa warna nominal sisa piutang agar tidak tertimpa warna dasar tabel */
    .table tbody td.text-danger, 
    .table tbody tr td.text-danger {
        color: #ef5350 !important; /* Merah tegas bernuansa pastel */
    }
    
    .table tbody td.text-success, 
    .table tbody tr td.text-success {
        color: #66bb6a !important; /* Hijau tegas bernuansa pastel */
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
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Daftar Piutang Pelanggan</h4>
</div>
<hr>

<div class="pagetitle">
  <!-- <h1></h1> -->
  <!-- <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
      <li class="breadcrumb-item active">Daftar Piutang</li>
    </ol>
  </nav> -->
</div>

<section class="section">
  <div class="card">
    <div class="card-body pt-4">
      
      <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- <h5 class="card-title p-0 m-0" style="font-size: 1.25rem;">Daftar Piutang Pelanggan</h5> -->
        <div>
          <a href="<?= base_url('daftar_piutang/exportPdfPiutang') ?>" target="_blank" class="btn btn-danger btn-sm me-2"><i class="bi bi-file-pdf me-1"></i> Cetak PDF</a>
          <a href="<?= base_url('daftar_piutang/exportExcelPiutang') ?>" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel me-1"></i> Export Excel</a>
        </div>
      </div>
      <hr style="border-color: #bbdefb; opacity: 0.7;">

      <?php if(session()->getFlashdata('pesan')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; border-radius: 12px;">
              <i class="bi bi-check-circle me-1"></i>
              <?= session()->getFlashdata('pesan'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      <?php endif; ?>

      <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col" style="width: 5%;">No</th>
              <th scope="col">Pelanggan</th>
              <th scope="col">Invoice</th>
              <th scope="col" class="text-end">Total Tagihan</th>
              <th scope="col" class="text-end">Sudah Dibayar</th>
              <th scope="col" class="text-end">Sisa Piutang</th>
              <th scope="col" class="text-center">Status</th>
              <th scope="col" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($piutang)): ?>
              <tr>
                <td colspan="8" class="text-center py-4">Belum ada data transaksi pelanggan.</td>
              </tr>
            <?php else: ?>
              <?php 
                $no = 1; 
                $total_tagihan_all = 0;
                $total_dibayar_all = 0;
                $total_piutang_all = 0;
              ?>
              <?php foreach($piutang as $row): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td class="fw-bold"><?= esc($row['pelanggan']) ?></td>
                  <td>#INV-<?= esc($row['invoice']) ?></td>
                  <td class="text-end">IDR <?= number_format($row['total_tagihan'], 0, ',', '.') ?></td>
                  <td class="text-end">IDR <?= number_format($row['sudah_dibayar'], 0, ',', '.') ?></td>
                  
                  <?php if($row['sisa_piutang'] > 0): ?>
                      <td class="text-end text-danger fw-bold">IDR <?= number_format($row['sisa_piutang'], 0, ',', '.') ?></td>
                      <td class="text-center"><span class="badge bg-warning text-dark">Belum Lunas</span></td>
                      <td class="text-center">
                          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalBayar<?= $row['invoice'] ?>">
                              <i class="bi bi-cash me-1"></i> Bayar
                          </button>
                      </td>
                  <?php else: ?>
                      <td class="text-end text-success fw-bold">IDR 0</td>
                      <td class="text-center"><span class="badge bg-success">Lunas</span></td>
                      <td class="text-center">
                          <span class="text-muted small"><i class="bi bi-check-all"></i> Selesai</span>
                      </td>
                  <?php endif; ?>
                </tr>

                <?php if($row['sisa_piutang'] > 0): ?>
                <div class="modal fade" id="modalBayar<?= $row['invoice'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['invoice'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $row['invoice'] ?>">Update Pembayaran - INV-<?= $row['invoice'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="<?= base_url('daftar_piutang/update_pembayaran') ?>" method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="id_transaksi" value="<?= $row['invoice'] ?>">
                            
                            <div class="mb-3">
                                <label class="form-label text-muted small">Nama Pelanggan</label>
                                <input type="text" class="form-control" value="<?= esc($row['pelanggan']) ?>" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small">Sisa Piutang Saat Ini</label>
                                    <input type="text" class="form-control text-danger fw-bold" value="IDR <?= number_format($row['sisa_piutang'], 0, ',', '.') ?>" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small">Input Nominal Bayar (IDR)</label>
                                    <input type="number" class="form-control" name="tambah_bayar" min="1" max="<?= $row['sisa_piutang'] ?>" required placeholder="Misal: 500000">
                                </div>
                            </div>
                            <small class="text-danger">*Nominal input tidak boleh lebih besar dari sisa piutang.</small>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php 
                  $total_tagihan_all += $row['total_tagihan'];
                  $total_dibayar_all += $row['sudah_dibayar'];
                  if($row['sisa_piutang'] > 0) {
                      $total_piutang_all += $row['sisa_piutang'];
                  }
                ?>
              <?php endforeach; ?>
              
              <tr style="background-color: #fffde7; font-weight: bold; color: #455a64;">
                <td colspan="3" class="text-center">Total Akumulasi Keseluruhan</td>
                <td class="text-end">IDR <?= number_format($total_tagihan_all, 0, ',', '.') ?></td>
                <td class="text-end">IDR <?= number_format($total_dibayar_all, 0, ',', '.') ?></td>
                <td class="text-end text-danger">IDR <?= number_format($total_piutang_all, 0, ',', '.') ?></td>
                <td colspan="2"></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</section>

<?= $this->endSection(); ?>