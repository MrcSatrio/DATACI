<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Authentikasi 
$routes->get('/', 'Auth\Auth::index');
$routes->post('/login', 'Auth\Auth::login');
$routes->get('/logout', 'Auth\Auth::logout');
$routes->post('/ceksaldo', 'Auth\Saldo::ceksaldo');
$routes->get('berkas/download/(:num)', 'Admin\Berkas::download/$1');

//FORGOT
$routes->get('/forgotpassword', 'Auth\Auth::forgot_password');
$routes->match(['get', 'post'], '/passwordreset', 'Auth\Auth::password_reset');
//endForgot
//reset page
$routes->get('/resetpassword', 'Auth\Auth::change_password');
$routes->match(['get', 'post'], '/updatepassword', 'Auth\Auth::update_password');
//endAuth
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTERS
//role admin
$routes->group('admin', ['filter' => 'roleFilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    //topbar
    $routes->get('ubah_password', 'Admin\Password::ubahPassword');
    $routes->post('update_password', 'Admin\Password::updatePassword');
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('update_profil', 'Admin\Profile::updateProfil');
    //endtopbar
    //Users
    $routes->get('create', 'Admin\User::userCreate');
    $routes->get('read', 'Admin\User::userRead');
    $routes->get('update/(:segment)', 'Admin\User::userUpdate/$1');
    $routes->get('delete/(:segment)', 'Admin\User::userDelete/$1');
    $routes->post('insert', 'Admin\User::userInsert');
    $routes->post('edit/(:segment)', 'Admin\User::userEdit/$1');
    //endUsers
    //Transaksi
    $routes->get('transaksi_inputkodebooking', 'Admin\Transaksi::transaksi_inputkodebooking');
    $routes->post('transaksi_validasiinputkodebooking', 'Admin\Transaksi::transaksi_validasiinputkodebooking');
    $routes->post('transaksi_approve', 'Admin\Transaksi::transaksi_approve');
    $routes->get('transaksi_riwayat', 'Admin\Transaksi::riwayat');
    //endTransaksi
    // Pengumuman
    $routes->get('form_upload', 'Admin\Berkas::create');
    $routes->post('save_pengumuman', 'Admin\Berkas::save');
    $routes->get('listPengumuman', 'Admin\Berkas::readBerkas');
    $routes->match(['get', 'post'], 'berkas/delete/(:num)', 'Admin\Berkas::delete/$1');
    $routes->get('modul', 'Admin\Berkas::modul');
    //endPengumuman
    //search
    $routes->post('search', 'Admin\Search::index');
    //endSearch
});
//role keuangan
$routes->group('keuangan', ['filter' => 'roleFilter'], function ($routes) {
    $routes->get('dashboard', 'Keuangan\Dashboard::index');
    //topbar
    $routes->get('ubah_password', 'Admin\Password::ubahPassword');
    $routes->post('update_password', 'Admin\Password::updatePassword');
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('update_profil', 'Admin\Profile::updateProfil');
    //endtopbar
    $routes->get('read', 'keuangan\User::userRead');
    $routes->get('create', 'Keuangan\User::create');
    $routes->post('insert', 'Keuangan\User::userInsert');
    // Pengumuman
    $routes->get('form_upload', 'Keuangan\Berkas::create');
    $routes->post('save_pengumuman', 'Keuangan\Berkas::save');
    $routes->get('listPengumuman', 'Keuangan\Berkas::readBerkas');
    $routes->match(['get', 'post'], 'berkas/delete/(:num)', 'Keuangan\Berkas::delete/$1');
    $routes->get('modul', 'Keuangan\Berkas::modul');
    //Transaksi
    //Transaksi
    $routes->get('transaksi_inputkodebooking', 'Keuangan\Transaksi::transaksi_inputkodebooking');
    $routes->post('transaksi_validasiinputkodebooking', 'Keuangan\Transaksi::transaksi_validasiinputkodebooking');
    $routes->post('transaksi_approve', 'Keuangan\Transaksi::transaksi_approve');
    $routes->post('cetak/(:segment)', 'Admin\Transaksi::cetak/$1');
    $routes->get('transaksi_riwayat', 'Keuangan\Transaksi::riwayat');
    //endTransaksi
    //search
    $routes->match(['get', 'post'], 'search', 'Admin\Search::index');


    //endSearch

});
//role operator
$routes->group('operator', ['filter' => 'roleFilter'], function ($routes) {
    $routes->get('dashboard', 'Operator\Dashboard::index');
    $routes->get('riwayat', 'Operator\Dashboard::riwayat');
    //topbar
    $routes->get('ubah_password', 'Admin\Password::ubahPassword');
    $routes->post('update_password', 'Admin\Password::updatePassword');
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('update_profil', 'Admin\Profile::updateProfil');
    //endtopbar
    //parkir
    $routes->post('check-out', 'Operator\CheckOut::index');
    //endParkir
    $routes->get('modul', 'Operator\Dashboard::modul');
    //search
    $routes->post('search', 'Operator\Search::index');
    //endSearch
});
//role user
$routes->group('user', ['filter' => 'roleFilter'], function ($routes) {
    $routes->get('dashboard', 'User\Dashboard::index');
    //topbar
    $routes->get('ubah_password', 'Admin\Password::ubahPassword');
    $routes->post('update_password', 'Admin\Password::updatePassword');
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('update_profil', 'Admin\Profile::updateProfil');
    //endtopbar
    //topup
    $routes->get('topup', 'User\Topup::index');
    $routes->post('transaksi_topup', 'Admin\Transaksi::topup');
    $routes->post('cancel/(:segment)', 'Admin\Transaksi::cancel/$1');
    $routes->post('bukti/(:segment)', 'Admin\Transaksi::bukti/$1');
    //endtopup
    //kartuhilang
    $routes->get('kartuhilang', 'User\KartuHilang::index');
    $routes->post('transaksi_kartuHilang', 'Admin\Transaksi::transaksi_kartuHilang');
    $routes->get('transaksi_result/(:any)/(:num)/(:num)', 'Admin\Transaksi::transaksi_result/$1/$2/$3');
    //endKartuhilang
    // Pengumuman
    $routes->get('pengumuman', 'User\Pengumuman::readBerkas');
    $routes->get('modul', 'User\Pengumuman::modul');
    //RIwayat
    $routes->get('riwayatTransaksi', 'User\Riwayat::riwayat');
    //endriwayat
    //search
    $routes->post('search', 'User\Search::index');
    //endSearch

});
//endFilters
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
