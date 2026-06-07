<?php

use App\Http\Controllers\ScannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scan', [ScannerController::class, 'index'])->name('scan.index');
Route::post('/scan', [ScannerController::class, 'store'])->name('scan.store');
