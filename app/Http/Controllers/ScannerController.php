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
        $validated = $request->validate([
            'barcodes' => 'required|array',
            'barcodes.*' => 'required|integer|min:1',
        ]);

        Log::info($validated['barcodes']);

        return redirect()->back()->with('success', 'Barcodes submitted successfully');
    }
}
