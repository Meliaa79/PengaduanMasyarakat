<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class RiwayatLaporanUserController extends Controller
{

    public function riwayatLaporanUser()
    {
        // Logika untuk menampilkan riwayat pengaduan user
        return view('riwayatlaporanuser');
    }
    
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('riwayatlaporanuser', ['pengaduan' => $pengaduan]);
    }


    public function show($id)
    {
        // Menampilkan detail pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function riwayatPengaduan()
{
    // Ambil semua pengaduan yang milik pengguna dengan status 'SELESAI'
    $pengaduansSelesai = Pengaduan::where('user_id', auth()->user()->id)
        ->where('status', 'SELESAI')
        ->get();

    return view('riwayatlaporanuser', compact('pengaduanSelesai'));
}
}
