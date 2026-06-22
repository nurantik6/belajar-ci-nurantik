<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
History Transaksi Pembelian <strong><?= $username ?></strong>
<hr>
<div class="table-responsive">
    <!-- Table with stripped rows -->
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
                        <!-- ($item['status'] == "1") ? "Sudah Selesai" : "Belum Selesai" ?> -->
                        <td><?php echo [
                                0 => 'Menunggu Pembayaran',
                                1 => 'Sudah Dibayar',
                                2 => 'Sedang Dikirim',
                                3 => 'Sudah Selesai',
                                4 => 'Dibatalkan'
                            ][$item['status']] ?? 'Status Tidak Diketahui' ?>
                        </td>
                        <td>
                            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                Detail
                            </button> -->

                            <!-- Detail Modal Begin -->
                            <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            if (!empty($product)) {
                                                foreach (
                                                    $product[$item['id']]
                                                    as $index2 => $item2
                                                ) : ?>
                                                    <?php echo $index2 + 1 .
                                                        ")" ?>
                                                    <?php if (
                                                        $item2['foto']
                                                        != '' and file_exists("img/" . $item2['foto'] . "")
                                                    ) : ?>
                                                        <img src="<?php echo base_url() . "img/" . $item2['foto'] ?>" width="100px">
                                                    <?php endif; ?>
                                                    <strong><?= $item2['nama']
                                                            ?></strong>
                                                    <?= number_to_currency($item2['harga'], 'IDR') ?>
                                                    <br>
                                                    <?= "(" . $item2['jumlah']
                                                        . " pcs)" ?><br>
                                                    <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                                    <hr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                            Ongkir <?= number_to_currency($item['ongkir'], 'IDR') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Detail Modal End -->

                        <td>
                            <?php if (!empty($item['bukti_pembayaran'])): ?>
                                <img src="<?= base_url('uploads/bukti/' . $item['bukti_pembayaran'])
                                            ?>" width="150px" alt="Bukti Pembayaran">
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#detailModal-<?= $item['id'] ?>"> Detail
                            </button>
                            <!-- Tombol dan Modal Upload Bukti -->
                            <?php if ($item['status'] == 0): ?>
                                <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#uploadModal-<?= $item['id'] ?>">
                                    Upload Bukti
                                </button>
                        </td>
                    </tr>
                    <!-- Modal Upload -->
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
    <!-- End Table with stripped rows -->
</div>
<?= $this->endSection() ?>