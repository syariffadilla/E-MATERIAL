<?php

use App\Http\Controllers\auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Kasir\DashboardKasirController;
use App\Http\Controllers\Manager\DashboardManagerController;
use App\Http\Controllers\Manager\RestoreController;
use App\Http\Controllers\Manager\SettingUsersController;
use App\Http\Controllers\Manager\PenjualanManagerController;
use App\Http\Controllers\Manager\DataBarangManagerController;
use App\Http\Controllers\Manager\StokBarangManagerController;
use App\Http\Controllers\Manager\ProfileTokoController;
use App\Http\Controllers\Manager\PelangganManagerController;
use App\Http\Controllers\Manager\PinPointController;
use App\Http\Controllers\Manager\SettingKategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SuplayerController;
use App\Http\Controllers\Kasir\StokKasirController;
use App\Http\Controllers\Kasir\CetakStrukController;
use App\Http\Controllers\Kasir\TransaksiController;
use App\Http\Controllers\Kasir\PelangganKasirController;
use App\Http\Controllers\ExcelController;/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/barang', [BarangController::class, 'index'])->name('barang');
// auth
Route::get('/', [LoginController::class, 'index'])->name('based')->middleware('checkLogin');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// password forgot
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'passwordEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPasswordToken'])->name('password.reset');
Route::post('/reset-password',  [ForgotPasswordController::class, 'updatePassword'])->name('password.update');


// kasir
Route::middleware(['auth'])->group(function () {
    Route::get('/autocomplite', [TransaksiController::class, 'autocomplete'])->name('autocomplete');

    // Route Kasir
    Route::get('/dashboard_kasir', [DashboardKasirController::class, 'index'])->name('dashboard_kasir');
    Route::get('/dashboard_kasir', [DashboardKasirController::class, 'index'])->name('dashboard_kasir');
    // Route::get('/penjualantanggalkasir', [DashboardKasirController::class, 'show'])->name('detail.penjualan.kasir');
    Route::delete('/hapuspenjualankasir/{id}', [DashboardKasirController::class, 'deleteData'])->name('hapus.penjualan.kasir');
    Route::get('/penjualankasir/{noTransaksi}', [DashboardKasirController::class, 'show'])->name('detail.penjualan.kasir');
    Route::get('penjualan/export/kasir',[DashboardKasirController::class, 'exportExcel'])->name('penjualan.export.kasir');
    Route::get('/penjualan/struk', [TransaksiController::class, 'struk'])->name('struk.penjualan');


    Route::get('/kasir_transaksi', [TransaksiController::class, 'index'])->name('kasir_transaksi');
    Route::get('/tambah-barang-button', [TransaksiController::class, 'tambahButtonBarang'])->name('tambah-barang-cart');
    Route::post('/add_barang', [TransaksiController::class, 'store'])->name('tambah.barang');
    Route::post('/savetransaksi', [TransaksiController::class, 'savetransaksi'])->name('savetransaksi');
    Route::get('/cetakstruk/{id}', [CetakStrukController::class, 'cetakstruk'])->name('cetakstruk');
    Route::get('/cetaksuratjalan/{id}', [CetakStrukController::class, 'SuratJalan'])->name('cetakSuratJalan');
    Route::get('/showPenjualanKasir/{id}', [CetakStrukController::class, 'show'])->name('showPenjualan');
    Route::resource('/stokbarangkasir', StokKasirController::class);
    Route::resource('/pelanggankasir', PelangganKasirController::class);


Route::resource('/barang',BarangController::class);
Route::resource('/kategori',KategoriController::class);
Route::get('/barang/{kategori}/{sub_kategori}', [BarangController::class, 'show'])->name('barang_show');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang_update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang_destroy');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/suplayer',[SuplayerController::class , 'index'])->name('supplier');
Route::post('/suplayer',[SuplayerController::class , 'store'])->name('supplier.add');
Route::put('/suplayer/{id}', [SuplayerController::class, 'update'])->name('suplayer.update');
Route::delete('/suplayer/{id}', [SuplayerController::class, 'destroy'])->name('suplayer_destroy');
Route::get('/struk-pdf',[TransaksiController::class, 'struk'])->name('struk');
Route::get('/getSubkategori/{kategoriId}', [DataBarangManagerController::class, 'getSubkategori']);
Route::get('/getDataBarang/{kategoriId}/{subkategoriId}', [DataBarangManagerController::class, 'getDataBarang'])->name('getDataBarang');
Route::get('manager/stok/export',[StokBarangManagerController::class, 'exportExcel'])->name('manager.stok.export');
   
});
// manager

Route::middleware(['auth', 'checkRoleManager'])->group(function () {

    Route::get('/dashboardmanager', [DashboardManagerController::class, 'index'])->name('dashboard_manager');
    Route::get('/databarangmanager', [DataBarangManagerController::class, 'index'])->name('data_barang_manager');
    Route::get('/databarangmanager/{id}', [DataBarangManagerController::class, 'show'])->name('data_barang_manager.show');
    Route::resource('/pinpoint', PinPointController::class);
    Route::resource('/setting_kategori', SettingKategoriController::class);
    // Route::get('/autocomplite', [TransaksiController::class, 'autocomplete'])->name('autocomplete.manager');

    Route::resource('/profile_toko', ProfileTokoController::class);
    Route::resource('/restore', RestoreController::class);
    Route::get('/penjualanmanager', [PenjualanManagerController::class, 'index'])->name('penjualan_manager');
    Route::post('/penjualantanggal', [PenjualanManagerController::class, 'index'])->name('penjualan_tanggal');
    Route::delete('/hapuspenjualan/{id}', [PenjualanManagerController::class, 'deleteData'])->name('hapus.penjualan');
    Route::get('/penjualanmanager/{noTransaksi}', [PenjualanManagerController::class, 'show'])->name('detail.penjualan');
    Route::get('/showPenjualan/{id}', [CetakStrukController::class, 'show'])->name('showPenjualanManager');

    Route::delete('/penjualanmanager/{noTransaksi}', [PenjualanManagerController::class, 'delete'])->name('detail.penjualan.delete');
    Route::get('/penjualanmanager/export', [PenjualanManagerController::class, 'exportCSV'])->name('penjualan_manager.export');
    Route::get('penjualan/export',[PenjualanManagerController::class, 'exportExcel'])->name('penjualan.export');
    Route::post('pelanggan/export',[PelangganManagerController::class, 'exportExcel'])->name('pelanggan.export');
    // Route::post('/export-excel', 'DataBarangManagerController@exportExcel')->name('barang.exportExcel');
    Route::get('manager/barang/exportexcel',[DataBarangManagerController::class, 'exportExcel'])->name('barang.exportExcel');
    Route::get('pelanggan/export/csv',[PelangganManagerController::class, 'exportCSV'])->name('pelanggan.export.csv');


    Route::resource('/barang/manager',DataBarangManagerController::class);
    Route::post('/barang/tambah',[DataBarangManagerController::class , 'storeSubKategori'])->name('subKategori.add');
    Route::resource('/kategori/manager',KategoriController::class);
    Route::get('/barang/manager/{id}', [DataBarangManagerController::class, 'show'])->name('barang_show_manager');
    Route::put('/barang/manager/{id}', [DataBarangManagerController::class, 'update'])->name('barang_update_manager');
    Route::delete('/barang/manager/{id}', [DataBarangManagerController::class, 'destroy'])->name('barang_destroy_manager');
    Route::put('/kategori/manager/{id}', [KategoriController::class, 'update'])->name('kategori.update_manager');
    Route::delete('/kategori/manager/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy_manager');
    Route::get('/generate-barang/{id}',[DataBarangManagerController::class, 'generateBarang'])->name('export-barang');
    // Route::get('barang/export', [DataBarangManagerController::class, 'exportExcel'])->name('barang.export');
   // Route::get('/getSubkategori/{kategoriId}', 'DataBarangManagerController@getSubkategori');


    Route::resource('/stokbarangmanager', StokBarangManagerController::class);
    Route::resource('/pelangganmanager', PelangganManagerController::class);
    Route::get('/stok/manager/pdf/{id}', [StokBarangManagerController::class, 'generateSTOK'])->name('cetakStokManager');
    Route::get('/generate-pdf',[PelangganManagerController::class, 'generatePDF'])->name('export-generate');
    Route::get('/generate-pdf2',[PenjualanManagerController::class, 'generatePDF2'])->name('export-generate2');
    Route::get('/export-excel',[PenjualanManagerController::class, 'export'])->name('export.excel');
    // Route::get('/export', [ExcelController::class, 'export'])->name('export');
    Route::get('manager/Barang/export',[DataBarangManagerController::class, 'exportExcel'])->name('manager.barang.export');

    // setting users
    Route::get('/settingusers', [SettingUsersController::class, 'index'])->name('setting_users');
    Route::post('/settingusers', [SettingUsersController::class, 'store'])->name('setting_users.create');
    Route::get('/settingusers/delete/', [SettingUsersController::class, 'destroy'])->name('setting_users.delete');
    Route::post('/settingusers/{id}/update/', [SettingUsersController::class, 'update'])->name('setting_users.update');

});
