<style>
    /* Import font Montserrat untuk logo dan Poppins untuk teks lainnya */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Poppins:wght@400;500&display=swap');

    /* Header Styling */
    .header {
        background: rgba(255, 255, 255, 0.95) !important; /* Efek transparan */
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 15px rgba(100, 181, 246, 0.1) !important;
        padding: 0 20px !important;
    }

    /* Kustomisasi Logo */
    .logo span {
        font-family: 'Montserrat', sans-serif !important;
        font-weight: 800 !important;
        font-size: 22px !important;
        letter-spacing: 1.2px !important;
        color: #1565c0 !important;
        text-transform: uppercase !important;
    }

    /* Kustomisasi Search Bar */
    .search-bar form {
        background-color: #f4f9ff !important;
        border-radius: 20px !important;
        padding: 5px 15px !important;
        border: 1px solid #bbdefb !important;
    }
    .search-bar input {
        background: transparent !important;
        border: none !important;
        color: #455a64 !important;
    }
    .search-bar button {
        background: transparent !important;
        border: none !important;
        color: #64b5f6 !important;
    }

    /* Kustomisasi Ikon Navigasi */
    .nav-icon {
        color: #1e88e5 !important;
        font-size: 1.2rem !important;
    }

    /* Kustomisasi Profil */
    .nav-profile span {
        font-family: 'Poppins', sans-serif !important;
        color: #455a64 !important;
        font-weight: 500 !important;
    }
    .dropdown-menu {
        border-radius: 12px !important;
        border: 1px solid #e3f2fd !important;
        box-shadow: 0 5px 15px rgba(100, 181, 246, 0.15) !important;
    }
    .dropdown-item i {
        color: #e57373 !important; /* Warna ikon logout pastel */
        margin-right: 10px;
    }
</style>

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?= base_url('/') ?>" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">TEMAN MINUM ANTIK</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn" style="color: #1e88e5;"></i>
    </div><div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search..." title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <!-- <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle border border-info"> -->
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        <?= session()->get('username'); ?> 
                        <small class="text-muted">(<?= session()->get('role'); ?>)</small>
                    </span>
                </a><ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout') ?>">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul></li></ul>
    </nav>
  </header>
