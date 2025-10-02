<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => 'admin routes loaded')->name('ping');
Route::get('/arsip', [AdminController::class, 'arsip'])->name('arsip');

// CRUD Arsip
Route::post('/arsip', [AdminController::class, 'storeArsip'])->name('arsip.store');
Route::get('/arsip/{id}/edit', [AdminController::class, 'editArsip'])->name('arsip.edit');
Route::put('/arsip/{id}', [AdminController::class, 'updateArsip'])->name('arsip.update');
Route::delete('/arsip/{id}', [AdminController::class, 'destroyArsip'])->name('arsip.destroy');

// CRUD Category
Route::get('/category', [AdminController::class, 'category'])->name('category.index');
Route::post('/category', [AdminController::class, 'storeCategory'])->name('category.store');
Route::get('/category/{id}/edit', [AdminController::class, 'editCategory'])->name('category.edit');
Route::put('/category/{id}', [AdminController::class, 'updateCategory'])->name('category.update');
Route::delete('/category/{id}', [AdminController::class, 'destroyCategory'])->name('category.destroy');
