<?php

use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('search', [SearchController::class, 'search']);
Route::delete('file', [FileController::class, 'destroy']);
Route::patch('file', [FileController::class, 'rename']);
Route::get('file', [FileController::class, 'download']);
Route::patch('directory', [DirectoryController::class, 'rename']);


