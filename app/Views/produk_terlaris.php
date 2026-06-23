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

    /* Kustomisasi Card */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
    }

    /* Kustomisasi Form Input & Label */
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

    /* Kustomisasi Tabel */
    .table {
        border-collapse: collapse !important;
        width: 100%;
    }
    .table-bordered, 
    .table-bordered th, 
    .table-bordered td {
        border: 1px solid #bbdefb !important; /* Garis biru pastel */
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
    <h4 class="m-0">Laporan Produk Terlaris</h4>
</div>
<hr>

<div class="pagetitle">
  <!-- <h1>Laporan Produk Terlaris</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
      <li class="breadcrumb-item active">Laporan Produk Terlaris</li>
    </ol>
  </nav> -->
</div>

<section class="section">
  <div class="card">
    <div class="card-body pt-4">
      
      <form action="" method="GET" class="mb-4">
        <div class="row g-3 align-items-end">
          <div class="col-auto">
            <label for="tanggal_awal" class="form-label text-muted" style="font-size: 14px;">Tanggal Awal</label>
            <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" value="<?= esc($tanggal_awal) ?>" required>
          </div>
          <div class="col-auto">
            <label for="tanggal_akhir" class="form-label text-muted" style="font-size: 14px;">Tanggal Akhir</label>
            <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="<?= esc($tanggal_akhir) ?>" required>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search me-2"></i>Tampilkan</button>
          </div>
          <div class="col text-end">
             <button type="button" class="btn btn-danger me-1"><i class="bi bi-file-pdf me-2"></i>Cetak PDF</button>
             <button type="button" class="btn btn-success"><i class="bi bi-file-excel me-2"></i>Export Excel</button>
          </div>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col" style="width: 5%;" class="text-center">No</th>
              <th scope="col">ID Produk</th>
              <th scope="col">Nama Produk</th>
              <th scope="col" class="text-center">Jumlah Terjual</th>
              <th scope="col" class="text-end">Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($produk_terlaris)): ?>
              <tr>
                <td colspan="5" class="text-center py-4">Tidak ada data penjualan pada rentang tanggal tersebut.</td>
              </tr>
            <?php else: ?>
              <?php $no = 1; $grand_total = 0; ?>
              <?php foreach($produk_terlaris as $row): ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td class="fw-bold text-secondary">#<?= esc($row['id_produk']) ?></td>
                  <td><?= esc($row['nama_produk']) ?></td>
                  <td class="text-center"><span class="badge bg-light text-dark border"><?= esc($row['jumlah_terjual']) ?> Item</span></td>
                  <td class="text-end fw-bold">IDR <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                </tr>
                <?php $grand_total += $row['total_harga']; ?>
              <?php endforeach; ?>
              
              <tr style="background-color: #fffde7; font-weight: bold; color: #455a64;">
                <td colspan="4" class="text-center text-uppercase">Total Nilai Penjualan Produk Terlaris</td>
                <td class="text-end text-success">IDR <?= number_format($grand_total, 0, ',', '.') ?></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</section>

<?= $this->endSection(); ?>