<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="<?= base_url() ?>" class="logo d-flex align-items-center w-auto">
                        <img src="<?= base_url() ?>NiceAdmin/assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block">Warung Antik</span>
                    </a>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Lengkapi Data Pendaftaran</h5>
                            <p class="text-center small">Silakan isi data akun baru Anda</p>
                        </div>

                        <?php if (session()->getFlashData('failed')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashData('failed') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/register_submit') ?>" method="POST" class="row g-3 needs-validation">
                            
                            <div class="col-12">
                                <label class="form-label">ID User</label>
                                <input type="text" class="form-control text-muted" value="Auto Generate (Mulai dari 11, dst)" disabled>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email Facebook/Google</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($email) ?>" required placeholder="Masukkan email biasa Anda">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required minlength="5" placeholder="Pilih username baru">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required minlength="6" placeholder="Buat password">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Daftar Sebagai (Role)</label>
                                <select name="role" class="form-select" required>
                                    <option value="guest">guest</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>

                            <div class="col-12 mt-4">
                                <button class="btn btn-primary w-100" type="submit">Simpan ke Database</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>