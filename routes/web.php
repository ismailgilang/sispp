<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TagihanSppController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('menu.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('Users', UsersController::class);
Route::resource('Jurusan', JurusanController::class);
Route::resource('Kelas', KelasController::class);
Route::resource('Siswa', SiswaController::class);
Route::resource('Spp', SppController::class);
Route::resource('Tagihan', TagihanSppController::class);
Route::resource('Pembayaran', PembayaranController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
