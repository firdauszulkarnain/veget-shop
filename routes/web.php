<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PesananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.dashboard2');
// });
Route::group(['middleware' => ['cache']], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::match(['get', 'post'], '/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/shop/detail-produk/{produk:id}', [ShopController::class, 'detail_produk'])->name('detail_produk');
    Route::get('/shop/modal/{produk:id}', [ShopController::class, 'produk_modal']);

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/proses_login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::match(['get', 'post'], '/registrasi', [AuthController::class, 'registrasi'])->name('register');
});

Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/shop/keranjang', [ShopController::class, 'keranjang'])->name('keranjang');
    Route::get('/shop/konfirmasi-pesanan/', [ShopController::class, 'konfirmasi_pesanan']);
    Route::post('/shop/proses_pesanan/', [ShopController::class, 'proses_pesanan']);
    Route::post('/shop/cek_produk', [ShopController::class, 'cek_produk']);
    Route::post('/kec_checkout', [ShopController::class, 'kec_checkout']);
    Route::post('/shop/detail_ongkir', [ShopController::class, 'detail_ongkir']);
    Route::get('/pesanan-saya', [ShopController::class, 'pesanan_saya'])->name('pesanan_saya');
    Route::post('/keranjang/{detpesanan:id}', [ShopController::class, 'update_qty'])->name('update_qty');
    Route::delete('/keranjang/{detpesanan:id}', [ShopController::class, 'delete_qty'])->name('delete_qty');
    Route::match(['get', 'post'], '/update-password', [HomeController::class, 'update_password'])->name('update_password');
    Route::post('/pesanan/{pesanan:no_pesanan}', [ShopController::class, 'pesanan_selesai'])->name('pesanan_selesai');
    Route::match(['get', 'post'], '/register-seller', [HomeController::class, 'register_seller'])->name('register_seller');
    Route::post('/shop/tambah_keranjang/{produk:id}', [ShopController::class, 'tambah_keranjang'])->name('tambah_keranjang');
    Route::match(['get', 'post'], '/pembayaran/{pesanan:no_pesanan}', [ShopController::class, 'pembayaran'])->name('pembayaran');
});

Route::group(['middleware' => ['auth', 'seller', 'cache']], function () {
    Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::resource('/produk', ProdukController::class)->except('show');
    Route::resource('/ongkir', OngkirController::class)->except(['edit', 'create']);
    Route::post('/stock/{produk:id}', [ProdukController::class, 'update_stock'])->name('update_stock');
    Route::post('/get_kecamatan', [OngkirController::class, 'get_kecamatan']);
    Route::get('/pesanan', [PesananController::class, 'index'])->name('seller.pesanan');
    Route::get('/pesanan/konfirmasi', [PesananController::class, 'konfirmasi_seller'])->name('seller.konfirmasi');
    Route::get('/pesanan/kirim', [PesananController::class, 'kirim'])->name('kirim');
    Route::get('/pesanan/{pesanan:no_pesanan}', [PesananController::class, 'detail'])->name('seller.detpes');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('seller.invoice');
    Route::get('/invoice/{invoice:no_invoice}', [InvoiceController::class, 'detail'])->name('seller.detinv');
    Route::put('/pesanan/konfirmasi_seller/{pesanan:id}', [PesananController::class, 'proses_konfirmasi']);
    Route::put('/pesanan/kirim/{pesanan:no_pesanan}', [PesananController::class, 'kirim_pesanan'])->name('kirim_pesanan');
    Route::match(['get', 'post'], '/seller/profile', [SellerController::class, 'profile'])->name('seller.profile');
});


Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin', 'cache']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');
    Route::get('/user/customer', [AdminController::class, 'customer'])->name('admin.user');
    Route::get('/user/seller', [AdminController::class, 'seller'])->name('admin.seller');
    Route::get('/user/admin', [AdminController::class, 'admin'])->name('admin.admin');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
    Route::get('/pesanan/konfirmasi', [PesananController::class, 'konfirmasi'])->name('admin.konfirmasi');
    Route::get('/pesanan/{pesanan:no_pesanan}', [PesananController::class, 'detail'])->name('admin.detpes');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');
    Route::get('/invoice/{invoice:no_invoice}', [InvoiceController::class, 'detail'])->name('admin.detinv');
    Route::delete('/user/{user:id}', [AdminController::class, 'delete_user'])->name('delete_user');
    Route::match(['get', 'post'], '/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::match(['get', 'post'], '/user/admin/tambah', [AdminController::class, 'tambah_admin'])->name('tambah_admin');
    Route::put('/pesanan/konfirmasi/{pesanan:no_pesanan}', [PesananController::class, 'konfirmasi_bayar'])->name('konfirmasi_pembayaran');
});
