<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => 'admin routes loaded')->name('ping');
Route::get('/arsip', [AdminController::class, 'arsip'])->name('arsip');
