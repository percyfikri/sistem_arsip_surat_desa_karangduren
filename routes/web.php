<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');   // halaman login
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');      // proses login

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');    // halaman register
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'Berhasil login!';
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');           // proses logout
});

Route::middleware(['auth'])        // middleware sesuai kebutuhan
    ->prefix('admin')              // URL akan menjadi /admin/...
    ->name('admin.')               // penamaan route: admin.*
    ->group(base_path('routes/admin.php'));
