<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('Users', UsersController::class);

Route::resource('Jurusan', JurusanController::class);

Route::resource('Kelas', KelasController::class);

Route::resource('Siswa', SiswaController::class);
Route::get('/edit/siswa/{nis}', [SiswaController::class, 'edit'])->name('Edit.siswa');
Route::put('/update/siswa/{nis}', [SiswaController::class, 'update'])->name('Update.siswa');
Route::delete('/hapus/siswa/{nis}', [SiswaController::class, 'destroy'])->name('Hapus.siswa');

Route::resource('Spp', SppController::class);
Route::post('/store/spp/', [SppController::class, 'store2'])->name('store.spp');
Route::get('/bayar/spp/{id}', [SppController::class, 'bayar'])->name('bayar.spp');
Route::put('/bayar/spp/{id}', [SppController::class, 'bayar2'])->name('update.bayar');

Route::get('/user/spp', [SppController::class, 'index2'])->name('user.spp');
Route::get('/user/pembayaran', [PembayaranController::class, 'index2'])->name('user.pembayaran');

Route::resource('Pembayaran', PembayaranController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
