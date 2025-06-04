<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratPengadaanController;
use App\Http\Controllers\SuratPengambilanController;
use App\Http\Controllers\BarangTersediaController;
use App\Http\Controllers\EmailPengadaanMendesakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuAdminController;

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
// Route::get('pdf-cuti/{id}', [AdminPdf::class, 'cuti']);
// Route::middleware(['guest'])->group(function () {
//     Route::get("/", [AuthController::class, 'view']);
//     Route::post("/", [AuthController::class, 'login']);
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'view']);
    Route::post('/', [AuthController::class, 'login']);
});

Route::fallback(function() {
    return response()->view('errors.404', [], 404);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('home', function () {
    return redirect('/surat_pengadaan');})->middleware('auth', 'cek.role:staf');

Route::get('/halaman_dashboard', [DashboardController::class, 'index'])->middleware('auth', 'cek.role:staf')->name('halaman_dashboard');

Route::get('/surat_pengadaan', [SuratPengadaanController::class, 'view'])->middleware('auth', 'cek.role:staf');
Route::get('/surat-pengadaan', [SuratPengadaanController::class, 'show'])->middleware('auth', 'cek.role:staf')->name('surat-pengadaan.show');
Route::post('/surat-pengadaan/store', [SuratPengadaanController::class, 'store'])->middleware('auth', 'cek.role:staf');
Route::get('/surat_pengadaan', [SuratPengadaanController::class, 'ambilbackend'])->middleware('auth', 'cek.role:staf');
Route::get('cetak_pengadaan/{id}', [SuratPengadaanController::class, 'cetakSuratPengadaan'])->middleware('auth', 'cek.role:staf')->name('surat.cetak');
Route::get('/surat_pengadaan/info/{id}', [SuratPengadaanController::class, 'infoSurat'])->middleware('auth', 'cek.role:staf')->name('surat.info');

Route::get('/barang_tersedia', [BarangTersediaController::class, 'view'])->middleware('auth', 'cek.role:staf');
Route::get('/barang-tersedia', [BarangTersediaController::class, 'show'])->middleware('auth', 'cek.role:staf')->name('barang-tersedia.data');

Route::get('/surat_pengambilan', [SuratPengambilanController::class, 'view'])->middleware('auth', 'cek.role:staf');
Route::get('/surat-pengambilan', [SuratPengambilanController::class, 'show'])->middleware('auth', 'cek.role:staf')->name('surat-pengambilan.show');
Route::post('/surat-pengambilan/store', [SuratPengambilanController::class, 'store'])->middleware('auth', 'cek.role:staf');
Route::get('/surat_pengambilan', [SuratPengambilanController::class, 'ambilbackend'])->middleware('auth', 'cek.role:staf');
Route::get('cetak_pengambilan/{id}', [SuratPengambilanController::class, 'cetakSuratPengambilan'])->middleware('auth', 'cek.role:staf')->name('surat.cetak1');
Route::get('/surat_pengambilan/info/{id}', [SuratPengambilanController::class, 'infoSurat'])->middleware('auth', 'cek.role:staf')->name('surat.info1');

Route::get('/pengadaan_mendesak', [EmailPengadaanMendesakController::class, 'view'])->middleware('auth', 'cek.role:staf');
Route::get('/pengadaan-mendesak', [EmailPengadaanMendesakController::class, 'show'])->middleware('auth', 'cek.role:staf')->name('pengadaan-mendesak.show');
Route::post('/pengadaan-mendesak/store', [EmailPengadaanMendesakController::class, 'store'])->middleware('auth', 'cek.role:staf');
Route::get('/pengadaan_mendesak', [EmailPengadaanMendesakController::class, 'ambilbackend'])->middleware('auth', 'cek.role:staf');

Route::get('/menu_admin', [MenuAdminController::class, 'view'])->middleware('auth', 'cek.role:staf');
Route::post('/menu-admin/update-status', [MenuAdminController::class, 'updateStatus'])->name('menu-admin.update-status');
Route::get('/menu-admin', [MenuAdminController::class, 'tampilkan'])->middleware('auth', 'cek.role:staf')->name('menu-admin.tampilkan');

