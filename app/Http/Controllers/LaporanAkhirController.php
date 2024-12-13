<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        return view('laporanakhir');
    }
}
