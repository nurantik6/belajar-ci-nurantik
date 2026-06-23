<?php
$hlm = "Home";
if(uri_string()!=""){
  $hlm = ucwords(uri_string());
}
?>

<?php
// Definisi default variabel untuk menghindari error Undefined variable
$hlm = $hlm ?? 'Dashboard'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TEMAN MINUM ANTIK - <?= esc($hlm) ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link href="<?= base_url() ?>NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>NiceAdmin/assets/css/style.css" rel="stylesheet">

    <style>
        /* Gaya Global Biru Pastel */
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f4f9ff !important; 
            color: #455a64 !important;
        }

        /* Card yang lebih elegan dan lembut */
        .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(100, 181, 246, 0.08) !important;
            background-color: #ffffff !important;
        }

        .card-title {
            color: #1565c0 !important;
            font-weight: 600 !important;
            font-size: 1.2rem !important;
        }

        /* Pagetitle & Breadcrumb */
        .pagetitle h1 {
            color: #1e88e5 !important;
            font-weight: 600 !important;
        }
        .breadcrumb-item a {
            color: #64b5f6 !important;
        }

        /* Scrollbar kustom agar terlihat keren */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #bbdefb; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #64b5f6; }
    </style>
</head>

<body>

    <?= $this->include('components/header') ?>
    <?= $this->include('components/sidebar') ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?= esc($hlm) ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                    <?php if($hlm != "Home"): ?>
                        <li class="breadcrumb-item active"><?= esc($hlm) ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div><section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-4">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><?= $this->include('components/footer') ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background: #64b5f6 !important;"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>NiceAdmin/assets/js/main.js"></script>
    
    <?= $this->renderSection('script') ?>

</body>

</html>