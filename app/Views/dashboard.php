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

    /* Kustomisasi Card Umum */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.1) !important;
        background-color: #ffffff !important;
    }

    /* Kustomisasi Header Card (Untuk Grafik & Tabel) */
    .card-header {
        background-color: #e3f2fd !important;
        color: #1565c0 !important;
        font-weight: 600 !important;
        border-bottom: 1px solid #bbdefb !important;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
        padding: 15px 20px !important;
    }

    /* Kustomisasi Card Metrik Atas (Border Pastel) */
    .card.border-primary { border: 2px solid #bbdefb !important; }
    .card.border-success { border: 2px solid #c8e6c9 !important; }
    .card.border-warning { border: 2px solid #ffecb3 !important; }
    .card.border-danger { border: 2px solid #ffcdd2 !important; }

    /* Teks dalam Card Metrik */
    .card-body h6 {
        color: #78909c !important;
        font-weight: 500 !important;
        margin-bottom: 10px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    .card-body h2, .card-body h5 {
        color: #1e88e5 !important;
        font-weight: 600 !important;
        margin-bottom: 0;
    }

    /* Kustomisasi Tabel Transaksi Terbaru */
    .table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        width: 100%;
        margin-bottom: 0 !important;
    }
    .table thead th {
        background-color: #f4f9ff !important;
        color: #1565c0 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid #bbdefb !important;
        padding: 12px 15px !important;
        border-top: none !important;
    }
    .table tbody td {
        color: #546e7a !important;
        padding: 12px 15px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #e3f2fd !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc !important; /* Warna selang-seling yang sangat tipis */
    }
    .table tbody tr:hover td {
        background-color: #f4f9ff !important; /* Efek hover biru pastel */
    }

    /* Kustomisasi Badges Status */
    .badge {
        padding: 0.55em 0.8em !important;
        border-radius: 12px !important;
        font-weight: 500 !important;
    }
    .bg-success { background-color: #e8f5e9 !important; color: #2e7d32 !important; border: 1px solid #c8e6c9 !important; }
    .bg-warning { background-color: #fff8e1 !important; color: #f57f17 !important; border: 1px solid #ffecb3 !important; }
    .bg-danger { background-color: #ffebee !important; color: #c62828 !important; border: 1px solid #ffcdd2 !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body text-center pt-4 pb-4">
                <h6>Total Produk</h6>
                <h2><?= $totalProduk ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body text-center pt-4 pb-4">
                <h6>Total User</h6>
                <h2><?= $totalUser ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body text-center pt-4 pb-4">
                <h6>Total Transaksi</h6>
                <h2><?= $totalTransaksi ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-danger">
            <div class="card-body text-center pt-4 pb-4">
                <h6>Total Omzet</h6>
                <h5><?= number_to_currency($totalOmzet, 'IDR') ?></h5>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                Grafik Penjualan Bulanan
            </div>
            <div class="card-body mt-3">
                <canvas id="penjualanChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                Status Pesanan
            </div>
            <div class="card-body mt-3">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Produk Terlaris
            </div>
            <div class="card-body mt-3">
                <canvas id="produkChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3 mb-4">
    <div class="card-header">
        5 Transaksi Terbaru
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%;">ID</th>
                    <th>Total</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksiTerbaru as $trx): ?>
                    <tr>
                        <td class="text-center fw-bold text-secondary">#<?= $trx['id'] ?></td>
                        <td class="fw-bold">
                            <?=number_to_currency($trx['total_harga'], 'IDR') ?>
                        </td>
                        <td class="text-center">
                            <?php
                            switch ($trx['status']) {
                                case 0:
                                    echo '<span class="badge bg-danger">Belum Bayar</span>';
                                    break;
                                case 1:
                                    echo '<span class="badge bg-warning text-dark">Verifikasi</span>';
                                    break;
                                case 2:
                                    echo '<span class="badge bg-success">Selesai</span>';
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    // Mengatur Font Global untuk Chart.js agar senada dengan tema Poppins
    Chart.defaults.font.family = "'Poppins', sans-serif";
    Chart.defaults.color = "#78909c";

    // PENJUALAN
    new Chart(
        document.getElementById('penjualanChart'), {
            type: 'line',
            data: {
                labels: <?= $bulan ?>,
                datasets: [{
                    label: 'Penjualan',
                    data: <?= $totalPenjualan ?>,
                    borderColor: '#64b5f6', /* Biru pastel garis */
                    backgroundColor: 'rgba(100, 181, 246, 0.2)', /* Fill biru transparan */
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            }
        });
    // PRODUK TERLARIS
    new Chart(
        document.getElementById('produkChart'), {
            type: 'bar',
            data: {
                labels: <?= $namaProduk ?>,
                datasets: [{
                    label: 'Qty Terjual',
                    data: <?= $qtyProduk ?>,
                    backgroundColor: '#81c784', /* Hijau pastel */
                    borderRadius: 6
                }]
            }
        });
    // STATUS PESANAN
    new Chart(
        document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: <?= $labelStatus ?>,
                datasets: [{
                    data: <?= $jumlahStatus ?>,
                    backgroundColor: [
                        '#e57373', /* Merah pastel untuk index 0 (misal: belum bayar) */
                        '#ffb74d', /* Orange/Kuning pastel untuk index 1 */
                        '#64b5f6', /* Biru pastel */
                        '#81c784'  /* Hijau pastel */
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%'
            }
        });
</script>
<?= $this->endSection() ?>