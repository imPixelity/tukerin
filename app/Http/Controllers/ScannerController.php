<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScannerController extends Controller
{
    public function index()
    {
        return view('scan.index');
    }

    public function store(Request $request)
    {
        Log::info($request->input('barcodes'));

        return view('scan.index');
    }
}
