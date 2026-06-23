<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    /* Font dan Elemen Dasar Modal */
    .modal-content {
        font-family: 'Poppins', sans-serif !important;
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(100, 181, 246, 0.25) !important;
        background-color: #ffffff !important;
    }

    /* Kustomisasi Header Modal */
    .modal-header {
        border-bottom: 1px solid #e3f2fd !important;
        background-color: #ffffff !important; /* Latar belakang putih bersih */
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }
    .modal-title {
        color: #1e88e5 !important; /* Biru terang untuk judul */
        font-weight: 600 !important;
        font-size: 1.2rem !important;
    }
    .btn-close {
        color: #42a5f5 !important;
    }

    /* Kustomisasi Body Modal (Teks dan Label) */
    .modal-body {
        color: #546e7a !important;
    }
    .modal-body label {
        color: #455a64 !important;
        font-weight: 500 !important;
        margin-bottom: 0.4rem !important;
    }

    /* Kustomisasi Form Input */
    .modal-body .form-control {
        border: 1px solid #bbdefb !important;
        border-radius: 8px !important;
        color: #455a64 !important;
        background-color: #f4f9ff !important; /* Biru pastel sangat tipis di dalam input */
        transition: all 0.3s ease;
    }
    .modal-body .form-control::placeholder {
        color: #90a4ae !important;
        opacity: 0.8 !important;
    }
    .modal-body .form-control:focus {
        border-color: #64b5f6 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 0.2rem rgba(100, 181, 246, 0.25) !important;
    }

    /* Kustomisasi Input Group (Prefix Rp) */
    .modal-body .input-group-text {
        background-color: #e3f2fd !important; /* Biru pastel untuk label 'Rp' */
        color: #1565c0 !important;
        border: 1px solid #bbdefb !important;
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
        font-weight: 500 !important;
    }

    /* Kustomisasi Footer Modal */
    .modal-footer {
        border-top: 1px solid #e3f2fd !important;
        background-color: #ffffff !important;
        border-bottom-left-radius: 16px !important;
        border-bottom-right-radius: 16px !important;
    }

    /* Kustomisasi Tombol dalam Modal */
    .modal-footer .btn {
        border-radius: 8px !important;
        font-weight: 500 !important;
        padding: 8px 20px !important;
        border: none !important;
        transition: all 0.3s ease !important;
    }
    
    /* Tombol Close (Secondary) */
    .modal-footer .btn-secondary {
        background-color: #cfd8dc !important; /* Abu-abu kebiruan pastel */
        color: #455a64 !important;
    }
    .modal-footer .btn-secondary:hover {
        background-color: #b0bec5 !important;
    }

    /* Tombol Simpan (Primary) */
    .modal-footer .btn-primary {
        background-color: #64b5f6 !important; /* Biru pastel */
        color: #ffffff !important;
    }
    .modal-footer .btn-primary:hover {
        background-color: #42a5f5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(100, 181, 246, 0.3) !important;
    }
</style>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open_multipart(base_url('produk')); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <div class="mb-3">
                    <?= form_label('Nama', 'nama'); ?>
                    <?= form_input([
                        'name'        => 'nama',
                        'id'          => 'nama',
                        'class'       => 'form-control',
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
                            'placeholder' => 'Contoh: 8500000',
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
                            'placeholder' => 'Contoh: 10899000',
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
                        'placeholder' => 'Jumlah Barang',
                        'required'    => true,
                        'min'         => '0'
                    ]); ?>
                </div>

                <div class="mb-3">
                    <?= form_label('Foto', 'foto'); ?>
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