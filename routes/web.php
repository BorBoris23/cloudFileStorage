<?php

use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index']);
Route::post('/files', [FileController::class, 'store']);
Route::post('/directory', [DirectoryController::class, 'store']);

Route::delete('/workToFile', [FileController::class, 'destroy']);
Route::patch('/workToFile', [FileController::class, 'rename']);
Route::post('/workToFile', [FileController::class, 'upload']);

Route::get('/path={path}', [DirectoryController::class, 'toDirectory'])->where('path', '.*');
