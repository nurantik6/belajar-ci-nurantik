<?php
helper('number');
?>
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>Laporan Pendapatan</h3>
<hr>
<form action="<?= base_url('laporan/pendapatan') ?>" method="get" class="row g-3 mb-4">
    <div class="col-md-3">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= esc($tanggal_awal ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= esc($tanggal_akhir ?? '') ?>">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </div>
    <div class="col-md-3 align-self-end text-end">
        <?php if (!empty($laporan)) : ?>
            <a href="<?=base_url("laporan/exportPdf?tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir") ?>" class="btn btn-danger">Cetak PDF</a>
            <a href="<?=base_url("laporan/exportExcel?tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir") ?>" class="btn btn-success">Export Excel</a>
        <?php endif; ?>
    </div>
</form>
<?php if (!empty($laporan)) : ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>User</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($laporan as $i => $row) :
                    $total += $row['total_harga'];
                ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($row['id']) ?></td>
                        <td><?= esc($row['created_at']) ?></td>
                        <td><?= esc($row['username']) ?></td>
                        <td><?= number_to_currency($row['total_harga'],'IDR') ?></td>
                        <td><?= [
                                'Pending',
                                'Paid',
                                'Shipped',
                                'Completed',
                                'Cancelled'
                            ][$row['status']] ?? 'Tidak Diketahui' ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="fw-bold table-warning">
                    <td colspan="4">Total Pendapatan</td>
                    <td><?= number_to_currency($total, 'IDR') ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>