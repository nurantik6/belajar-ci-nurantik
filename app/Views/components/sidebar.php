<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

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

        <li class="nav-item">
            <a class="nav-link <?= (uri_string() == 'penjualan') ? "" : "collapsed" ?>" href="penjualan">
                <i class="bi bi-list"></i>
                <span>Penjualan</span>
            </a>
        </li><!-- End Penjualan Nav -->

        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= (strpos(uri_string(), 'laporan/pendapatan') === 0) ? '' : 'collapsed' ?>" href="<?= base_url('laporan/pendapatan') ?>">
                    <i class="bi bi-card-list"></i>
                    <span>Laporan Pendapatan</span>
                </a>
            </li><!-- End Laporan Nav -->
        <?php
        }
        ?>

        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?= (strpos(uri_string(), 'dashboard') === 0) ?'' : 'collapsed' ?>" href="<?= base_url('/dashboard') ?>">
                    <i class="bi bi-card-list"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
        }
        ?>

    </ul>
</aside><!-- End Sidebar-->