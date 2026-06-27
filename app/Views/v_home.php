<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* ... (CSS sebelumnya tetap biarkan) ... */

    /* Memaksa form agar setinggi kolomnya */
    form {
        height: 100%;
    }

    /* Update: Kustomisasi Kartu Produk (Card) */
    .card {
        border: none !important;
        border-radius: 16px !important;
        background-color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.15) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100% !important; /* Pastikan tinggi kartu sama semua */
    }

    /* ... (CSS hover card dan tombol biarkan saja) ... */

    /* Update: Kustomisasi Gambar Produk */
    .card-body img {
        border-radius: 12px;
        transition: opacity 0.3s ease;
        width: 100%; /* Lebar penuh menyesuaikan kontainer */
        height: 250px; /* Tinggi gambar dibuat seragam */
        object-fit: contain; /* Menjaga rasio gambar asli tanpa terpotong (sangat cocok untuk background putih) */
        margin-bottom: 15px;
    }

    .card-body img:hover {
        opacity: 0.9;
    }

    /* Mengubah font keseluruhan dan latar belakang konten utama */
    body,
    .main,
    #main {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f4f9ff !important;
        /* Latar belakang biru pastel sangat cerah */
    }

    /* Kustomisasi Kartu Produk (Card) */
    .card {
        border: none !important;
        border-radius: 16px !important;
        background-color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(100, 181, 246, 0.15) !important;
        /* Bayangan biru yang lembut */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efek hover pada kartu */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(100, 181, 246, 0.25) !important;
    }

    /* Kustomisasi Teks Judul dan Harga */
    .card-title {
        color: #1e88e5 !important;
        /* Biru tegas untuk teks agar terbaca jelas */
        font-size: 1.15rem !important;
        font-weight: 600 !important;
        line-height: 1.6 !important;
        margin-top: 15px;
        margin-bottom: 20px;
    }

    /* Kustomisasi Tombol Beli */
    .btn-info.rounded-pill {
        background-color: #64b5f6 !important;
        /* Biru pastel cerah */
        border-color: #64b5f6 !important;
        color: #ffffff !important;
        /* Teks putih */
        font-weight: 500 !important;
        padding: 8px 30px !important;
        box-shadow: 0 4px 10px rgba(100, 181, 246, 0.3) !important;
        transition: all 0.3s ease;
    }

    /* Efek hover pada Tombol Beli */
    .btn-info.rounded-pill:hover {
        background-color: #42a5f5 !important;
        /* Warna biru sedikit lebih gelap saat disentuh */
        border-color: #42a5f5 !important;
        box-shadow: 0 6px 15px rgba(66, 165, 245, 0.4) !important;
        transform: scale(1.05);
    }

    /* Kustomisasi Gambar Produk */
    .card-body img {
        border-radius: 12px;
        transition: opacity 0.3s ease;
    }

    .card-body img:hover {
        opacity: 0.9;
    }

    /* Kustomisasi Alert Notifikasi */
    .alert-success {
        background-color: #e3f2fd !important;
        color: #1565c0 !important;
        border: 1px solid #bbdefb !important;
        border-radius: 12px !important;
        font-weight: 500 !important;
    }
</style>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="row align-items-stretch">
    <?php foreach ($products as $key => $item) : ?>
        <div class="col-lg-6 mb-4"> <?= form_open('keranjang', ['class' => 'h-100']) ?> <?= form_hidden([
                'id'    => $item['id'],
                'nama'  => $item['nama'],
                'harga' => $item['harga'],
                'foto'  => $item['foto']
            ]) ?>
            
            <div class="card h-100"> <div class="card-body text-center d-flex flex-column"> <img src="<?= base_url() . "img/" . $item['foto'] ?>" alt="<?= $item['nama'] ?>">
                    
                    <div class="mt-auto">
                        <h5 class="card-title"><?= $item['nama'] ?><br><?= number_to_currency($item['harga'], 'IDR') ?></h5>
                        
                        <?php if (session()->get('role') == 'admin'): ?>
                            <button type="button" class="btn btn-secondary disabled" style="background-color: #b0bec5; border: none; border-radius: 20px; padding: 6px 30px; cursor: not-allowed; opacity: 0.7;" disabled>
                                Beli
                            </button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div> 

<?= $this->endSection() ?>