<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    /* Sidebar Styling - Biru Pastel Modern */
    .sidebar {
        font-family: 'Poppins', sans-serif !important;
        background-color: #ffffff !important;
        border-right: none !important; /* Menghilangkan garis keras */
        box-shadow: 4px 0 20px rgba(100, 181, 246, 0.08) !important; /* Menggantinya dengan bayangan halus */
        padding: 20px 15px;
    }

    /* Styling untuk Judul Kategori (seperti: LAPORAN & PENJUALAN) */
    .sidebar-nav .nav-heading {
        font-size: 0.95rem !important;
        text-transform: uppercase !important;
        letter-spacing: 1.2px !important;
        color: #90caf9 !important; /* Biru pastel cerah */
        font-weight: 700 !important;
        padding: 10px 15px 5px 15px !important;
        margin-top: 15px !important;
    }

    .sidebar-nav .nav-link {
        background: transparent !important;
        color: #1565c0 !important; 
        border-radius: 12px !important;
        padding: 12px 18px !important;
        margin-bottom: 8px !important;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important; /* Transisi sangat mulus */
        font-weight: 500 !important;
        font-size: 0.95rem !important;
        display: flex;
        align-items: center;
    }

    /* Efek Interaktif Hover (Saat kursor diarahkan) */
    .sidebar-nav .nav-link:hover {
        background-color: #f4f9ff !important;
        color: #1e88e5 !important;
        transform: translateX(6px); /* Efek bergeser sedikit ke kanan, membuatnya interaktif */
    }

    /* Efek saat Menu Aktif */
    .sidebar-nav .nav-link:not(.collapsed) {
        background: #eaf3ff !important; /* Latar biru sangat lembut */
        color: #1565c0 !important; /* Teks biru gelap/tegas */
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(100, 181, 246, 0.15) !important; /* Bayangan pada tombol aktif */
    }

    /* Ikon Sidebar Default */
    .sidebar-nav .nav-link i {
        color: #90caf9 !important; /* Biru redup */
        font-size: 1.2rem !important;
        margin-right: 15px !important;
        transition: all 0.3s ease !important;
    }

    /* Ikon saat di-hover atau Aktif */
    .sidebar-nav .nav-link:hover i,
    .sidebar-nav .nav-link:not(.collapsed) i {
        color: #1e88e5 !important; /* Ikon menyala menjadi biru cerah */
        transform: scale(1.15); /* Ikon sedikit membesar (pop-up effect) */
    }
</style>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'dashboard') ? '' : 'collapsed' ?>" href="<?= base_url('/dashboard') ?>">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == '') ? "" : "collapsed" ?>" href="<?= base_url('/') ?>">
                <i class="bi bi-house-door"></i>
                <span>Home</span>
            </a>
        </li>

        <?php if (session()->get('role') != 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="<?= base_url('keranjang') ?>">
                    <i class="bi bi-cart3"></i>
                    <span>Keranjang</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'produk') ? "" : "collapsed" ?>" href="<?= base_url('produk') ?>">
                    <i class="bi bi-box-seam"></i>
                    <span>Produk</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') != 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'profile') ? "" : "collapsed" ?>" href="<?= base_url('profile') ?>">
                    <i class="bi bi-person-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-heading">Laporan & Penjualan</li> 
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'penjualan') ? "" : "collapsed" ?>" href="<?= base_url('penjualan') ?>">
                    <i class="bi bi-bag-check"></i>
                    <span>Penjualan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'daftar_piutang') ? "" : "collapsed" ?>" href="<?= base_url('daftar_piutang') ?>">
                    <i class="bi bi-credit-card"></i>
                    <span>Daftar Piutang</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'laporan_arus_kas') ? "" : "collapsed" ?>" href="<?= base_url('laporan_arus_kas') ?>">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Laporan Arus Kas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'laporan_laba_rugi') ? "" : "collapsed" ?>" href="<?= base_url('laporan_laba_rugi') ?>">
                    <i class="bi bi-graph-up"></i>
                    <span>Laba Rugi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'laporan_pendapatan') ? "" : "collapsed" ?>" href="<?= base_url('laporan_pendapatan') ?>">
                    <i class="bi bi-pie-chart"></i>
                    <span>Laporan Pendapatan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'laporan_produk_terlaris') ? "" : "collapsed" ?>" href="<?= base_url('laporan_produk_terlaris') ?>">
                    <i class="bi bi-stars"></i>
                    <span>Produk Terlaris</span>
                </a>
            </li>
        <?php endif; ?>

    </ul>
</aside>