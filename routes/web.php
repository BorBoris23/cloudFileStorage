<?php

use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index'])->name('toDirectory');
Route::post('/uploadFiles', [FileController::class, 'store']);
Route::post('/uploadDirectory', [DirectoryController::class, 'store']);
