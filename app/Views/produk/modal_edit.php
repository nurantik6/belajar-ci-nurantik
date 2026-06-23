<?php foreach ($products as $index => $produk) : ?>    
    <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart(base_url('produk/edit/' . $produk['id'])); ?>
                <?= csrf_field(); ?>

                <div class="modal-body">
                    <div class="mb-3">
                        <?= form_label('Nama', 'nama'); ?>
                        <?= form_input([
                            'name'        => 'nama',
                            'id'          => 'nama',
                            'class'       => 'form-control',
                            'value'       => $produk['nama'],
                            'placeholder' => 'Nama Barang',
                            'required'    => true
                        ]); ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Harga Beli / Modal', 'harga_beli'); ?>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <?= form_input([
                                'type'        => 'number',
                                'name'        => 'harga_beli',
                                'id'          => 'harga_beli',
                                'class'       => 'form-control',
                                'value'       => $produk['harga_beli'],
                                'placeholder' => 'Harga Beli (Modal)',
                                'required'    => true,
                                'min'         => '0'
                            ]); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Harga Jual', 'harga'); ?>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <?= form_input([
                                'type'        => 'number',
                                'name'        => 'harga',
                                'id'          => 'harga',
                                'class'       => 'form-control',
                                'value'       => $produk['harga'],
                                'placeholder' => 'Harga Jual',
                                'required'    => true,
                                'min'         => '0'
                            ]); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Jumlah', 'jumlah'); ?>
                        <?= form_input([
                            'type'        => 'number', 
                            'name'        => 'jumlah',
                            'id'          => 'jumlah',
                            'class'       => 'form-control',
                            'value'       => $produk['jumlah'],
                            'placeholder' => 'Jumlah Barang',
                            'required'    => true,
                            'min'         => '0'
                        ]); ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Foto Saat Ini:', ''); ?><br>
                        <img src="<?= base_url('img/' . $produk['foto']); ?>" width="100">
                    </div>

                    <div class="form-check mb-3">
                        <?= form_checkbox([
                            'name'    => 'check',
                            'id'      => 'check' . $produk['id'], // ID unik
                            'value'   => '1',
                            'class'   => 'form-check-input'
                        ]); ?>
                        <?= form_label(
                            'Ceklis jika ingin mengganti foto',
                            'check' . $produk['id'],
                            ['class' => 'form-check-label']
                        ); ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Upload Foto Baru', 'foto'); ?>
                        <?= form_upload([
                            'name'  => 'foto',
                            'id'    => 'foto',
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <?= form_submit('submit', 'Simpan', ['class' => 'btn btn-primary']); ?>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <?php endforeach ?>