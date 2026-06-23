<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('produk', 'ProdukController::index', ['filter' => 'auth']);

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);
$routes->get('checkout', 'TransaksiController::checkout', ['filter' =>'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->post('/upload-bukti', 'TransaksiController::uploadBukti');
$routes->post('penjualan/updateStatus/(:any)', 'TransaksiController::updateStatus/$1', ['filter' => 'auth']);
$routes->get('penjualan', 'Home::penjualan', ['filter' => 'auth']); 
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);
$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->resource('api', ['controller' => 'apiController']);

$routes->get('laporan_pendapatan', 'LaporanController::pendapatan');
$routes->get('laporan_produk_terlaris', 'Laporan::produk_terlaris');

$routes->get('laporan/exportPdf', 'LaporanController::exportPdf');
$routes->get('laporan/exportExcel', 'LaporanController::exportExcel');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('daftar_piutang', 'LaporanController::daftar_piutang');
$routes->post('daftar_piutang/update_pembayaran', 'LaporanController::update_pembayaran');
$routes->get('daftar_piutang/exportPdfPiutang', 'LaporanController::exportPdfPiutang'); 
$routes->get('daftar_piutang/exportExcelPiutang', 'LaporanController::exportExcelPiutang');

$routes->get('laporan_arus_kas', 'LaporanController::arus_kas');
$routes->post('laporan_arus_kas/simpan', 'LaporanController::simpan_arus_kas');
$routes->get('laporan_arus_kas/exportPdf', 'LaporanController::exportPdfArusKas');
$routes->get('laporan_arus_kas/exportExcel', 'LaporanController::exportExcelArusKas');

$routes->get('laporan_laba_rugi', 'LaporanController::laba_rugi');
$routes->get('laporan_laba_rugi/exportPdf', 'LaporanController::exportPdfLabaRugi');

// ==========================================
// RUTE LOGIN & DAFTAR VIA GOOGLE / FACEBOOK
// ==========================================

// Rute pemicu login sosmed
$routes->get('auth/google', 'AuthController::google');
$routes->get('auth/facebook', 'AuthController::facebook');

// Rute tangkapan balik (callback) dari Google & Facebook
$routes->get('auth/google/callback', 'AuthController::googleCallback');
$routes->get('auth/facebook/callback', 'AuthController::facebookCallback');

// Rute form pendaftaran lanjutan
$routes->get('auth/register_form', 'AuthController::register_form');
$routes->post('auth/register_submit', 'AuthController::register_submit');