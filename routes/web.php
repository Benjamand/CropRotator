<?php

use Illuminate\Support\Facades\Route;

Route::get('/create', [\App\Http\Controllers\AlbumController::class, 'create'])->name('create');

Route::get('/', [\App\Http\Controllers\AlbumController::class, 'index']);

Route::post('/', [\App\Http\Controllers\AlbumController::class, 'store'])->name('store');
