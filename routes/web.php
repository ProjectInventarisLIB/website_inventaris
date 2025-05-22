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
Route::middleware(['guest'])->group(function () {
    Route::get("/", [AuthController::class, 'view']);
    Route::post("/", [AuthController::class, 'login']);
});

Route::get('home', function() {
    return redirect('/surat_pengadaan');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get("/surat_pengadaan", [SuratPengadaanController::class, 'view']);
Route::get('/surat-pengadaan', [SuratPengadaanController::class, 'show'])->name('surat-pengadaan.show');
Route::post('/surat-pengadaan/store', [SuratPengadaanController::class, 'store']);
Route::get('/surat_pengadaan', [SuratPengadaanController::class, 'ambilbackend']);
Route::get('cetak_pengadaan/{id}', [SuratPengadaanController::class, 'cetakSuratPengadaan'])->name('surat.cetak');

Route::get("/barang_tersedia", [BarangTersediaController::class, 'view']);
Route::get('/barang-tersedia', [BarangTersediaController::class, 'show'])->name('barang-tersedia.data');

Route::get("/surat_pengambilan", [SuratPengambilanController::class, 'view']);
Route::get('/surat-pengambilan', [SuratPengambilanController::class, 'show'])->name('surat-pengambilan.show');
Route::post('/surat-pengambilan/store', [SuratPengambilanController::class, 'store']);
Route::get('/surat_pengambilan', [SuratPengambilanController::class, 'ambilbackend']);
Route::get('cetak_pengambilan/{id}', [SuratPengambilanController::class, 'cetakSuratPengambilan'])->name('surat.cetak');

Route::get("/pengadaan_mendesak", [EmailPengadaanMendesakController::class, 'view']);
Route::get('/pengadaan-mendesak', [EmailPengadaanMendesakController::class, 'show'])->name('pengadaan-mendesak.show');
Route::post('/pengadaan-mendesak/store', [EmailPengadaanMendesakController::class, 'store']);
Route::get('/pengadaan_mendesak', [EmailPengadaanMendesakController::class, 'ambilbackend']);

Route::get('/halaman_dashboard', [DashboardController::class, 'index'])->name('halaman_dashboard');


















