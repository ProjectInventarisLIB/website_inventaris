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
use App\Http\Controllers\SeluruhAdminController;

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

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'staf') {
            return redirect()->route('halaman_dashboard');
        } elseif ($role === 'staf_gudang') {
            return redirect()->route('dashboard_admin');
        } else {
            Auth::logout();
            return redirect('/')->withErrors(['login' => 'Role tidak dikenali.']);
        }
    }
    return view('login');})->name('login');

Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// STAF
Route::middleware(['cek.role:staf'])->group(function () {
    Route::get('home', fn() => redirect('/halaman_dashboard'));

    Route::get('/halaman_dashboard', [DashboardController::class, 'index'])->name('halaman_dashboard');

    // Surat Pengadaan
    Route::get('/surat_pengadaan', [SuratPengadaanController::class, 'view']);
    Route::get('/surat-pengadaan', [SuratPengadaanController::class, 'show'])->name('surat-pengadaan.show');
    Route::post('/surat-pengadaan/store', [SuratPengadaanController::class, 'store']);
    Route::get('/surat_pengadaan/info/{id}', [SuratPengadaanController::class, 'infoSurat'])->name('surat.info');
    Route::get('/surat_pengadaan', [SuratPengadaanController::class, 'ambilbackend']);
    Route::get('cetak_pengadaan/{id}', [SuratPengadaanController::class, 'cetakSuratPengadaan'])->name('surat.cetak');

    // Barang Tersedia
    Route::get('/barang_tersedia', [BarangTersediaController::class, 'view']);
    Route::get('/barang-tersedia', [BarangTersediaController::class, 'show'])->name('barang-tersedia.data');

    // Surat Pengambilan
    Route::get('/surat_pengambilan', [SuratPengambilanController::class, 'view']);
    Route::get('/surat-pengambilan', [SuratPengambilanController::class, 'show'])->name('surat-pengambilan.show');
    Route::post('/surat-pengambilan/store', [SuratPengambilanController::class, 'store']);
    Route::get('/surat_pengambilan', [SuratPengambilanController::class, 'ambilbackend']);
    Route::get('cetak_pengambilan/{id}', [SuratPengambilanController::class, 'cetakSuratPengambilan'])->name('surat.cetak1');
    Route::get('/surat_pengambilan/info/{id}', [SuratPengambilanController::class, 'infoSurat'])->name('surat.info1');

    // Pengadaan Mendesak
    Route::get('/pengadaan_mendesak', [EmailPengadaanMendesakController::class, 'view']);
    Route::get('/pengadaan-mendesak', [EmailPengadaanMendesakController::class, 'show'])->name('pengadaan-mendesak.show');
    Route::post('/pengadaan-mendesak/store', [EmailPengadaanMendesakController::class, 'store']);
    Route::get('/pengadaan_mendesak', [EmailPengadaanMendesakController::class, 'ambilbackend']);


    Route::get('/menu_admin', [MenuAdminController::class, 'view']);
    Route::post('/menu-admin/update-status', [MenuAdminController::class, 'updateStatus'])->name('menu-admin.update-status');
    Route::get('/menu-admin', [MenuAdminController::class, 'tampilkan'])->name('menu-admin.tampilkan');
});


Route::middleware(['cek.role:staf_gudang'])->group(function () {
    Route::get('/dashboard_admin', [SeluruhAdminController::class, 'index'])->name('dashboard_admin');
    Route::get('/rancangan_anggaran', [SeluruhAdminController::class, 'anggaran']);
    Route::get('/master_barang', [SeluruhAdminController::class, 'masterBarang']);
    Route::get('/lacak_barang', [SeluruhAdminController::class, 'lacakBarang']);
    Route::get('/inventaris_barang', [SeluruhAdminController::class, 'inventarisBarang']);
    Route::get('/surat_permohonan', [SeluruhAdminController::class, 'suratPermohonan']);
    Route::get('/data_vendor', [SeluruhAdminController::class, 'dataVendor']);
    Route::get('/order', [SeluruhAdminController::class, 'order']);
});
