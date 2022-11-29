<?php

use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index'])->name('toDirectory');

Route::post('/uploadFiles', [FileController::class, 'store']);
Route::post('/uploadDirectory', [DirectoryController::class, 'store']);

Route::delete('/workToFile', [FileController::class, 'destroy']);
Route::patch('/workToFile', [FileController::class, 'rename']);
Route::post('/workToFile', [FileController::class, 'upload']);

Route::patch('/renameDirectory', [DirectoryController::class, 'rename']);

Route::post('/search', [SearchController::class, 'search']);
