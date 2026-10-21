<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\QrLocationController;
use App\Http\Controllers\Admin\QrTokenController;
use App\Http\Controllers\Admin\QrDisplayController;
use App\Http\Controllers\Siswa\ScanController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('classes', ClassRoomController::class);
        Route::resource('students', StudentController::class);
        Route::resource('qr-locations', QrLocationController::class);

        // Generate token QR harian untuk semua lokasi aktif (mencegah duplikat per hari)
        Route::post('/qr-tokens/generate', [QrTokenController::class, 'generate'])
            ->name('qr-tokens.generate');

        // Menonaktifkan token QR tertentu secara manual
        Route::post('/qr-tokens/{qrToken}/deactivate', [QrTokenController::class, 'deactivate'])
            ->name('qr-tokens.deactivate');

        // Mengaktifkan kembali token QR yang sebelumnya dinonaktifkan
        Route::post('/qr-tokens/{qrToken}/activate', [QrTokenController::class, 'activate'])
            ->name('qr-tokens.activate');

        // Menampilkan halaman berisi gambar QR Code dari sebuah token
        Route::get('/qr-tokens/{qrToken}/display', [QrDisplayController::class, 'show'])
            ->name('qr-tokens.display');
    });

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/scan', function () {
            return view('siswa.scan');
        })->name('scan');
    });

// Route scan QR: WAJIB login sebagai siswa (supaya sistem tahu siapa yang absen).
// Kalau siswa belum login, Laravel otomatis mengarahkan ke halaman login dulu.
Route::get('/scan/{token}', [ScanController::class, 'scan'])
    ->middleware(['auth', 'role:siswa'])
    ->name('qr.scan');

require __DIR__.'/auth.php';
