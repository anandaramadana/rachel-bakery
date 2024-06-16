<?php

use App\Models\Kategori;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Sistem\SliderController;
use App\Http\Controllers\Sistem\UserListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/informasi-order', function () {
    return view('informasi-order');
});

Route::get('/layanan', function () {
    return view('layanan');
});

Route::get('/pemesanan', function () {
    return view('pemesanan');
});

Route::group(['middleware' => ['auth', 'CekRole:customer']], function () {
    Route::get('/profile/{id}/edit', [UserController::class,'update_user'])->name('update_user');
    Route::post('/profile/{id}/edit', [UserController::class, 'edit_gambar'])->name('edit_gambar');
    Route::post('/update_user', [UserController::class,'edit_user'])->name('edit_user');

    Route::get('/pemesanan/{id}', [PemesananController::class, 'hal_pesan'])->name('hal_pesan');
    Route::post('/tambah_pemesanan', [PemesananController::class, 'tambah_pemesanan'])->name('tambah_pemesanan');
    Route::post('/beli_sekarang', [PemesananController::class, 'beli_sekarang'])->name('beli_sekarang');
    Route::post('/checkout', [PemesananController::class, 'checkout'])->name('checkout');
    Route::get('/riwayat', [PemesananController::class,'riwayat'])->name('riwayat');
    Route::get('/riwayat/{id}/delete', [PemesananController::class,'delete_pemesanan'])->name('delete_pemesanan');
    Route::post('/bukti/{id}', [PemesananController::class, 'bukti'])->name('bukti');
    Route::get('/invoice/{id}', [PemesananController::class, 'invoice'])->name('invoice');
    Route::get('/cetak_bukti/{id}', [PemesananController::class, 'cetak_butki'])->name('cetak_butki');

    Route::get('/keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
    Route::post('/tambah_keranjang', [KeranjangController::class, 'tambah_keranjang'])->name('tambah_keranjang');
    Route::get('/keranjang/{id}/delete', [KeranjangController::class,'delete_keranjang'])->name('delete_keranjang');

});

Route::group(['middleware' => ['auth', 'CekRole:admin']], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/profile-admin/{id}/edit', [UserController::class,'update_admin'])->name('update_admin');
    Route::post('/profile-admin/{id}/edit', [UserController::class, 'edit_gambar_admin'])->name('edit_gambar_admin');
    Route::post('/update_admin', [UserController::class,'edit_admin'])->name('edit_admin');

    Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
    Route::post('/tambah_kategori', [KategoriController::class,'tambah_kategori'])->name('tambah_kategori');
    Route::get('/kategori/{id}/edit', [KategoriController::class,'update_kategori'])->name('update_kategori');
    Route::post('/kategori/{id}/update_kategori', [KategoriController::class,'edit_kategori'])->name('edit_kategori');
    Route::get('/kategori/{id}/delete', [KategoriController::class,'delete_kategori'])->name('delete_kategori');

    Route::get('/list-menu', [MenuController::class, 'list_menu'])->name('list-menu');
    Route::post('/tambah_menu', [MenuController::class,'tambah_menu'])->name('tambah_menu');
    Route::get('/menu/{id}/edit', [MenuController::class,'update_menu'])->name('update_menu');
    Route::post('/menu/{id}/update_menu', [MenuController::class,'edit_menu'])->name('edit_menu');
    Route::get('/menu/{id}/delete', [MenuController::class,'delete_menu'])->name('delete_menu');

    Route::get('/order', [PemesananController::class,'order'])->name('order');
    Route::get('/laporan', [PemesananController::class,'laporan'])->name('laporan');
    Route::get('/orderedit/{id}', [PemesananController::class, 'pesanankonfirmasi'])->name('pesanankonfirmasi');
    Route::get('/orderdp/{id}', [PemesananController::class, 'pesanandp'])->name('pesanandp');
    Route::get('/orderbatal/{id}', [PemesananController::class, 'pesananbatal'])->name('pesananbatal');
    Route::get('/laporan', [PemesananController::class,'laporan'])->name('laporan');
    Route::get('/cetak_laporan', [PemesananController::class,'cetak_laporan'])->name('cetak_laporan');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/tambah_pembayaran', [PembayaranController::class,'tambah_pembayaran'])->name('tambah_pembayaran');
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class,'update_pembayaran'])->name('update_pembayaran');
    Route::post('/pembayaran/{id}/update_pembayaran', [PembayaranController::class,'edit_pembayaran'])->name('edit_pembayaran');
    Route::get('/pembayaran/{id}/delete', [PembayaranController::class,'delete_pembayaran'])->name('delete_pembayaran');

    Route::get('/akun-admin', [UserListController::class, 'akun_admin'])->name('akun-admin');
    Route::get('/akun-customer', [UserListController::class, 'akun_customer'])->name('akun-customer');
    Route::post('/tambah_akun', [UserListController::class,'tambah_akun'])->name('tambah_akun');
    Route::get('/akun/{id}/edit', [UserListController::class,'update_akun'])->name('update_akun');
    Route::post('/akun/{id}/update_akun', [UserListController::class,'edit_akun'])->name('edit_akun');
    Route::get('/akun/{id}/delete', [UserListController::class,'delete_akun'])->name('delete_akun');

    Route::get('/slider', [SliderController::class, 'index'])->name('slider');
    Route::post('/tambah_slider', [SliderController::class,'tambah_slider'])->name('tambah_slider');
    Route::get('/slider/{id}/edit', [SliderController::class,'update_slider'])->name('update_slider');
    Route::post('/slider/{id}/update_slider', [SliderController::class,'edit_slider'])->name('edit_slider');
    Route::get('/slider/{id}/delete', [SliderController::class,'delete_slider'])->name('delete_slider');

});

//* Login & Register *//
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/tambah_user', [UserController::class, 'tambah_user'])->name('tambah_user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//* Halaman Depan Guest *//
Route::get('/', [KategoriController::class, 'index'])->name('index');
Route::get('/menu', [MenuController::class, 'index'])->name('index');
Route::get('/menu-detail/{id}', [MenuController::class, 'detail_menu'])->name('detail_menu');
Route::get('/informasi-pembayaran', [PembayaranController::class, 'hal_depan'])->name('informasi-pembayaran');
