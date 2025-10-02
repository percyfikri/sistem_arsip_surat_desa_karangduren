<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => 'admin routes loaded')->name('ping');