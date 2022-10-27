<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index']);
Route::post('/', [FileController::class, 'store']);
//Route::get('/usersFiles', [FileController::class, 'show']);

Route::delete('/workToFileForm', [FileController::class, 'destroy']);
Route::patch('/workToFileForm', [FileController::class, 'rename']);
Route::post('/workToFileForm', [FileController::class, 'upload']);
