<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= (strpos(uri_string(), 'dashboard') === 0) ? '' : 'collapsed' ?>" href="<?= base_url('/dashboard') ?>">
                    <i class="bi bi-card-list"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
        }
        ?>

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == '') ? "" : "collapsed" ?>" href="/">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
                <i class="bi bi-cart-check"></i>
                <span>Keranjang</span>
            </a>
        </li><!-- End Keranjang Nav -->

        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
                    <i class="bi bi-receipt"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php
        }
        ?>

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == 'profile') ? "" : "collapsed" ?>" href="profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Nav -->

        <?php
        if (session()->get('role') == 'admin') {
        ?>

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == 'penjualan') ? "" : "collapsed" ?>" href="penjualan">
                <i class="bi bi-list"></i>
                <span>Penjualan</span>
            </a>
        </li><!-- End Penjualan Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('daftar_piutang') ?>">
                <i class="bi bi-wallet2"></i>
                <span>Daftar Piutang</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('laporan_arus_kas') ?>">
                <i class="bi bi-cash-coin"></i>
                <span>Laporan Arus Kas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('laporan_laba_rugi') ?>">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Laporan Laba Rugi</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link <?= (strpos(uri_string(), 'laporan_pendapatan') === 0) ? '' : 'collapsed' ?>" href="<?= base_url('laporan_pendapatan') ?>">
                <i class="bi bi-card-list"></i>
                <span>Laporan Pendapatan</span>
            </a>
        </li><!-- End Laporan Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('laporan_produk_terlaris') ?>">
                <i class="bi bi-star"></i>
                <span>Laporan Produk Terlaris</span>
            </a>
        </li>

        <?php
        }
        ?>

    </ul>
</aside><!-- End Sidebar-->