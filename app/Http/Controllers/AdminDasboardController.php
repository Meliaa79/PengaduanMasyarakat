<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminDasboardController extends Controller
{
    public function index()
    {
        // Ambil data grafik di sini juga
        $statusData = Pengaduan::selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->get();

        // Format data grafik dan kirim ke view
        return view('admindashboard', compact('statusData'));
    }

    
}