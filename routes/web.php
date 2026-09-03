<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
// Import semua Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

// 1. Rute untuk meng-install tabel otomatis
Route::get('/setup-notif', function () {
    if (!Schema::hasTable('notifikasis')) {
        Schema::create('notifikasis', function ($table) {
            $table->id();
            $table->string('nim');
            $table->text('pesan');
            $table->string('jenis')->default('warning');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
        return "BERHASIL! Tabel Notifikasi sudah dibuat di Database. Silakan kembali ke web.";
    }
    return "Tabel sudah siap.";
});

// 2. Rute untuk fitur "Tandai sudah dibaca"
Route::post('/notifikasi/read', function () {
    // Menyesuaikan dengan kolom yang ada di tabel users (nim atau username)
    $nim = auth()->user()->nim ?? auth()->user()->username;
    DB::table('notifikasis')->where('nim', $nim)->update(['is_read' => true]);
    return back();
})->name('notifikasi.read');

// Rute Profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

// ==========================================
// 1. HALAMAN LOGIN (Tidak Perlu Satpam)
// ==========================================
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/lupa-password', [AuthController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/lupa-password', [AuthController::class, 'processForgot'])->name('password.reset');

// ==========================================
// 2. HALAMAN DALAM (Wajib Login / Satpam 'auth')
// ==========================================
Route::middleware(['auth'])->group(function () {

    // --- DASHBOARD (Semua yang login bisa akses) ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/update-info', [App\Http\Controllers\DashboardController::class, 'updateInfo'])->name('dashboard.update_info');
    Route::post('/dashboard/update-poin', [App\Http\Controllers\DashboardController::class, 'updatePoin'])->name('dashboard.update_poin');
    Route::post('/dashboard/upload-dokumentasi', [App\Http\Controllers\DashboardController::class, 'uploadDokumentasi'])->name('dashboard.upload_dokumentasi');
    Route::post('/dashboard/hapus-dokumentasi', [App\Http\Controllers\DashboardController::class, 'hapusDokumentasi'])->name('dashboard.hapus_dokumentasi');
    Route::post('/dashboard/devisi', [\App\Http\Controllers\DashboardController::class, 'storeDevisi'])->name('dashboard.store_devisi');
    Route::put('/dashboard/devisi/{id}', [\App\Http\Controllers\DashboardController::class, 'updateDevisi'])->name('dashboard.update_devisi');
    Route::delete('/dashboard/devisi/{id}', [\App\Http\Controllers\DashboardController::class, 'destroyDevisi'])->name('dashboard.destroy_devisi');
    Route::post('/dashboard/kategori-poin', [\App\Http\Controllers\DashboardController::class, 'storeKategoriPoin'])->name('dashboard.kategori_poin.store');
    Route::put('/dashboard/kategori-poin/{id}', [\App\Http\Controllers\DashboardController::class, 'updateKategoriPoin'])->name('dashboard.kategori_poin.update');
    Route::delete('/dashboard/kategori-poin/{id}', [\App\Http\Controllers\DashboardController::class, 'destroyKategoriPoin'])->name('dashboard.kategori_poin.destroy');

    // --- POIN KEAKTIFAN ---
    // Semua bisa melihat poin
    Route::get('/poin', [PoinController::class, 'index'])->middleware('role:admin,sekretaris,anggota')->name('poin');
    // TAPI HANYA Admin & Sekretaris yang bisa simpan/ubah poin
    Route::post('/poin/update', [PoinController::class, 'updatePoin'])->middleware('role:admin,sekretaris')->name('poin.update');
    Route::post('/poin/edit-keterangan', [App\Http\Controllers\PoinController::class, 'editKeterangan'])->name('poin.edit_keterangan');
    Route::post('/poin/{id}/batal', [PoinController::class, 'batalPoin'])->name('poin.batal');

    // ==========================================
    // KELOMPOK A: KHUSUS ADMIN & SEKRETARIS
    // ==========================================
    Route::middleware(['role:admin,sekretaris'])->group(function () {

        // Kelola User
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        // Absensi
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    });

    // ==========================================
    // KELOMPOK B: KHUSUS ADMIN, SEKRETARIS & BENDAHARA
    // ==========================================
    Route::middleware(['role:admin,sekretaris,bendahara'])->group(function () {

        // Kegiatan
        Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
        Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::put('/kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('/kegiatan/hapus/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

        // Laporan Umum
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/cetak-word/{devisi}', [LaporanController::class, 'cetakWord'])->name('laporan.cetakWord');
        Route::get('/laporan/preview/{devisi}', [LaporanController::class, 'preview'])->name('laporan.preview');
        Route::get('/laporan/absensi/{id}', [LaporanController::class, 'cetakAbsensi'])->name('laporan.absensi');
        Route::get('/laporan/poin', [LaporanController::class, 'cetakPoin'])->name('laporan.poin');
    });

    // ==========================================
    // KELOMPOK C: KHUSUS ADMIN & BENDAHARA
    // ==========================================
    Route::middleware(['role:admin,bendahara'])->group(function () {

        // Anggaran
        Route::get('/rancangan-anggaran', [AnggaranController::class, 'index'])->name('anggaran');
        Route::post('/rancangan-anggaran/store', [AnggaranController::class, 'store'])->name('anggaran.store');
    });
});
// ==========================================
// 3. RUTE VERIFIKASI QR CODE (Bisa diakses tanpa login)
// ==========================================
Route::get('/verifikasi-dokumen', [\App\Http\Controllers\LaporanController::class, 'verifikasiDokumen'])->name('verifikasi.dokumen');
Route::get('/verifikasi-laporan/{jenis}/{id}', [App\Http\Controllers\LaporanController::class, 'verifikasi'])->name('laporan.verifikasi');
