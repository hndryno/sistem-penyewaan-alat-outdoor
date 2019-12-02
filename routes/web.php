<?php

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
//     return view('welcome');
// });

Route::get('/', 'Frontend\FrontendController@beranda')->name('beranda');
Route::get('/beranda', 'Frontend\FrontendController@beranda')->name('beranda');
Route::get('/produk', 'Frontend\FrontendController@produk')->name('produk');
Route::get('/hubungi', 'Frontend\FrontendController@hubungi')->name('hubungi');
Route::get('/syarat', 'Frontend\FrontendController@syarat')->name('syarat');
Route::get('/daftar', 'Frontend\FrontendController@daftar')->name('daftar');
Route::get('/checkout', 'Frontend\FrontendController@checkout')->name('checkout');
Route::get('/deskripsi/{id}', 'Frontend\FrontendController@deskripsi')->name('deskripsi');
Route::post('/daftarBaru', 'Frontend\FrontendController@daftarBaru')->name('daftarBaru');
Route::get('/addToCart/{id}','Frontend\CartController@addToCart')->name('addToCart');
Route::get('/lihatPesanan','Frontend\CartController@lihatPesanan')->name('lihatPesanan');
Route::delete('/deleteCart/{id}','Frontend\CartController@deleteItems')->name('deleteItems');
Route::match(['put','patch'],'/updateCart/{id}','Frontend\CartController@updateCart')->name('updateCart');
Route::post('/pembayaran','Frontend\FrontendController@pembayaran')->name('pembayaran');
Route::get('/transfer/{kode_transaksi}','Frontend\FrontendController@transfer')->name('transfer');
Route::get('/cekKodeTransaksi','Frontend\FrontendController@cekKodeTransaksi')->name('cekKodeTransaksi');
Route::get('/pembayaran/kodeTransaksi','Frontend\FrontendController@kodeTransaksi')->name('kodeTransaksi');
Route::get('/tunai/{kode_transaksi}','Frontend\FrontendController@tunai')->name('tunai');
Route::get('/bankTransfer','Frontend\FrontendController@bankTransferGet')->name('bankTransferGet');
Route::post('/bankTransferPost', 'Frontend\FrontendController@bankTransferPut')->name('bankTransferPut');
Route::get('/cekTransaksi/{kode_transaksi}', 'Frontend\FrontendController@cekTransaksi')->name('cekTransaksi');
Route::get('/profile', 'Frontend\FrontendController@profile')->name('profile')->middleware('auth');
Route::put('/ubahProfile/{id}', 'Frontend\FrontendController@ubahProfile')->name('ubahProfile')->middleware('auth');
Route::get('/ubahPasswordUser/{id}', 'Frontend\FrontendController@ubahPasswordUser')->name('ubahPasswordUser')->middleware('auth');
Route::put('/updatePassword/{id}', 'Frontend\FrontendController@updatePassword')->name('updatePassword')->middleware('auth');
Route::get('/cetakTransaksi', 'Frontend\FrontendController@cetak_pdf_user')->name('cetak_pdf_user');
Route::get('/filter/{id}', 'Frontend\FrontendController@filter')->name('filter');

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/home', 'Admin\AdminController@index')->name('admin.home');
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::resource('kategori', 'Admin\KategoriController');
    Route::resource('barang', 'Admin\BarangController');
    Route::resource('transaksi', 'Admin\TransaksiController');
    Route::put('transaksi/status/{id}', 'Admin\TransaksiController@statusOrder')->name('statusOrder');
    Route::put('transaksi/konfirmasi/{id}', 'Admin\TransaksiController@konfirmasi')->name('konfirmasi');
    Route::get('/bermasalah', 'Admin\TransaksiController@bermasalah')->name('transaksi.bermasalah');
    Route::get('/semua/transaksi', 'Admin\TransaksiController@all')->name('all');
    Route::get('/data/transaksi', 'Admin\TransaksiController@dataTransaksi')->name('dataTransaksi');
    Route::get('/data/denda', 'Admin\TransaksiController@dataDenda')->name('dataDenda');
    Route::get('/semua/transaksi/bank', 'Admin\TransaksiController@transaksiBank')->name('transaksiBank');
    Route::resource('profile', 'Admin\ProfileController');
    Route::resource('manajemenuser', 'Admin\ManajemenUserController');
    Route::resource('manajemenadmin', 'Admin\ManajemenAdminController');
    Route::post('transaksi/denda/{id}', 'Admin\TransaksiController@denda')->name('transaksi.denda');
    Route::get('/log/transaksi', 'Admin\TransaksiController@log')->name('log');
    Route::delete('/log/transaksi/delete/{id}', 'Admin\TransaksiController@selesai')->name('selesai');
    Route::get('/log/transaksi/konfirmasi/selesai/{kode_transaksi}', 'Admin\TransaksiController@perhitunganDenda')->name('perhitunganDenda');
    Route::delete('/log/transaksi/delete/{kode_transaksi}', 'Admin\TransaksiController@selesaiSemua')->name('selesaiSemua');
    Route::delete('/log/{id}', 'Admin\TransaksiController@hapusLog')->name('deleteLog');
    Route::get('/userTransaksi/{kode_transaksi}', 'Admin\TransaksiController@userTransaksiShow')->name('userTransaksi.show');
    Route::get('/lihatDenda/{id}', 'Admin\TransaksiController@lihatDenda')->name('lihatDenda');
    Route::get('/cetakpdf', 'Admin\TransaksiController@cetak_pdf')->name('cetakpdf');
    Route::post('/transaksi/selesai', 'Admin\TransaksiController@transaksiSelesai')->name('transaksiSelesai');
    Route::put('/transaksi/pengembalian/{id}', 'Admin\TransaksiController@pengembalian')->name('pengembalian');
});

Route::get('/home', 'HomeController@index')->name('home');
