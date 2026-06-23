<style>
/* Sidebar Styling - Biru Pastel Modern */
.sidebar {
    background-color: #ffffff !important;
    border-right: 1px solid #e3f2fd !important;
    padding: 20px 15px;
}

.sidebar-nav .nav-link {
    background: transparent !important;
    color: #546e7a !important;
    border-radius: 12px !important;
    padding: 12px 20px !important;
    margin-bottom: 5px !important;
    transition: all 0.3s ease !important;
    font-weight: 500 !important;
}

/* Efek saat Menu Aktif */
.sidebar-nav .nav-link:not(.collapsed) {
    background: linear-gradient(90deg, #e3f2fd 0%, #bbdefb 100%) !important;
    color: #1565c0 !important;
}

/* Efek Hover */
.sidebar-nav .nav-link:hover {
    background-color: #f4f9ff !important;
    color: #1565c0 !important;
}

/* Ikon Sidebar */
.sidebar-nav .nav-link i {
    color: #64b5f6 !important;
    font-size: 1.1rem !important;
    margin-right: 15px !important;
}

.sidebar-nav .nav-link:not(.collapsed) i {
    color: #1565c0 !important;
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

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="<?= base_url('keranjang') ?>">
                <i class="bi bi-cart3"></i>
                <span>Keranjang</span>
            </a>
        </li>

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'produk') ? "" : "collapsed" ?>" href="<?= base_url('produk') ?>">
                    <i class="bi bi-box-seam"></i>
                    <span>Produk</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == 'profile') ? "" : "collapsed" ?>" href="<?= base_url('profile') ?>">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>
        </li>

        <?php if (session()->get('role') == 'admin'): ?>
            <li class="nav-heading">Laporan & Penjualan</li> <li class="nav-item">
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