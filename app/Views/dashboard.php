<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body text-center">
                <h6>Total Produk</h6>
                <h2><?= $totalProduk ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body text-center">
                <h6>Total User</h6>
                <h2><?= $totalUser ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body text-center">
                <h6>Total Transaksi</h6>
                <h2><?= $totalTransaksi ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-danger">
            <div class="card-body text-center">
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
            <div class="card-body">
                <canvas id="penjualanChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                Status Pesanan
            </div>
            <div class="card-body">
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
            <div class="card-body">
                <canvas id="produkChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        5 Transaksi Terbaru
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksiTerbaru as $trx): ?>
                    <tr>
                        <td><?= $trx['id'] ?></td>
                        <td>
                            <?=number_to_currency($trx['total_harga'], 'IDR') ?>
                        </td>
                        <td>
                            <?php
                            switch ($trx['status']) {
                                case 0:
                                    echo '<span class="badge bg-danger">Belum Bayar</span>';
                                    break;
                                case 1:
                                    echo '<span class="badge bg-warning">Verifikasi</span>';
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
    // PENJUALAN
    new Chart(
        document.getElementById('penjualanChart'), {
            type: 'line',
            data: {
                labels: <?= $bulan ?>,
                datasets: [{
                    label: 'Penjualan',
                    data: <?= $totalPenjualan ?>,
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
                    data: <?= $qtyProduk ?>
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
                    data: <?= $jumlahStatus ?>
                }]
            }
        });
</script>
<?= $this->endSection() ?>