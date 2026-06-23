<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<!-- Kustomisasi CSS Tema Biru Pastel -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    /* Font dan Latar Belakang Utama */
    body, .register {
        font-family: 'Poppins', sans-serif !important;
        background-color: #e3f2fd !important; /* Latar belakang biru pastel cerah */
        color: #455a64 !important;
    }

    /* Kustomisasi Form (Card) */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(100, 181, 246, 0.2) !important; /* Bayangan biru yang sangat lembut */
        background-color: #ffffff !important;
    }

    /* Teks Judul dan Sub-judul */
    .card-title {
        color: #1e88e5 !important;
        font-weight: 600 !important;
    }
    p.small, span.text-muted {
        color: #78909c !important;
    }

    /* Kustomisasi Input Form */
    .form-control {
        border-color: #bbdefb !important;
        color: #546e7a !important;
        border-radius: 8px !important;
    }
    .form-control:focus {
        border-color: #64b5f6 !important;
        box-shadow: 0 0 0 0.25rem rgba(100, 181, 246, 0.25) !important;
    }
    .input-group-text {
        background-color: #f0f8ff !important;
        color: #42a5f5 !important;
        border-color: #bbdefb !important;
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
    }

    /* Kustomisasi Tombol Utama (Login) */
    .btn-primary {
        background-color: #64b5f6 !important; /* Biru pastel untuk tombol */
        border-color: #64b5f6 !important;
        color: #ffffff !important;
        font-weight: 500 !important;
        border-radius: 8px !important;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #42a5f5 !important; /* Sedikit lebih gelap saat di-hover */
        border-color: #42a5f5 !important;
        transform: translateY(-1px);
    }

    /* Kustomisasi Tombol Outline (Facebook) */
    .btn-outline-primary {
        color: #42a5f5 !important;
        border-color: #bbdefb !important;
        border-radius: 8px !important;
        background-color: transparent !important;
    }
    .btn-outline-primary:hover {
        background-color: #e3f2fd !important;
        color: #1e88e5 !important;
    }

    /* Kustomisasi Tombol Outline (Google) */
    .btn-outline-danger {
        color: #e57373 !important;
        border-color: #ffcdd2 !important;
        border-radius: 8px !important;
        background-color: transparent !important;
    }
    .btn-outline-danger:hover {
        background-color: #ffebee !important;
        color: #d32f2f !important;
    }

    /* Teks Logo */
    .logo span {
        color: #1565c0 !important;
        font-family: 'Poppins', sans-serif !important;
        font-weight: 600 !important;
    }
    
    /* Warna Garis Pemisah (HR) */
    hr {
        background-color: #bbdefb !important;
        opacity: 0.5 !important;
    }
</style>

<?php
$username = [
    'name'      => 'username',
    'id'        => 'username',
    'class'     => 'form-control',
    'required'  => true,
    'minlength' => 6
];

$password = [
    'name'      => 'password',
    'id'        => 'password',
    'class'     => 'form-control',
    'required'  => true,
    'minlength' => 7
];
?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="<?= base_url() ?>" class="logo d-flex align-items-center w-auto text-decoration-none">
                        <img src="<?= base_url() ?>NiceAdmin/assets/img/logo.png" alt="" style="max-height: 45px; margin-bottom: 5px;">
                        <span class="d-none d-lg-block">TEMAN MINUM ANTIK</span>
                    </a>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                            <p class="text-center small">Enter your username & password to login</p>
                        </div>

                        <?php if (session()->getFlashData('failed')) : ?>
                            <div class="col-12 alert alert-danger" role="alert">
                                <hr>
                                <p class="mb-0">
                                    <?= session()->getFlashData('failed') ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?= form_open('login', 'class="row g-3 needs-validation"') ?>

                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <?= form_input($username) ?>
                                <div class="invalid-feedback">Please enter your username.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <?= form_password($password) ?>
                            <div class="invalid-feedback">Please enter your password!</div>
                        </div>

                        <div class="col-12 mt-4">
                            <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary w-100']) ?>
                        </div>

                            <?php if (session()->getFlashData('success')) : ?>
                                <div class="col-12 alert alert-success mt-3" role="alert">
                                    <hr>
                                    <p class="mb-0"><?= session()->getFlashData('success') ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="col-12 mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <hr class="flex-grow-1 m-0">
                                    <span class="mx-3 text-muted small">Atau daftar dengan</span>
                                    <hr class="flex-grow-1 m-0">
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="<?= base_url('auth/google') ?>" class="btn btn-outline-danger">
                                        <i class="bi bi-google me-2"></i> Daftar dengan Google
                                    </a>
                                    <a href="<?= base_url('auth/facebook') ?>" class="btn btn-outline-primary">
                                        <i class="bi bi-facebook me-2"></i> Daftar dengan Facebook
                                    </a>
                                </div>
                            </div>

                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>