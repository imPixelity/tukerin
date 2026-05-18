<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scan', function () {
    return view('scan');
});

Route::post('/log', function (Request $request) {
    Log::info($request->toArray());
})->name('log');
