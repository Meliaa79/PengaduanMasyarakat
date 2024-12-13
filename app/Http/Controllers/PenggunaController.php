<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PenggunaController extends Controller
{
    // Fungsi untuk menampilkan pengaduan pengguna
    public function index()
{
    $user = session('user');  // Mengambil data pengguna dari session

    if (!$user) {
        // Jika tidak ada data pengguna di session, redirect ke halaman login
        return redirect('/login')->with('error', 'Anda belum login!');
    }

    // Ambil data pengaduan milik pengguna berdasarkan nama
    $pengaduan = Pengaduan::where('nama', $user->nama)->get()->map(function ($item) {
        // Tanggal sekarang, dengan waktu diatur ke awal hari (00:00:00)
        $tanggalSekarang = now()->startOfDay();

        // Tentukan tanggal akhir untuk menghitung umur (tanggal dikerjakan jika ada)
        $tanggalAkhir = $item->tanggal_dikerjakan ? $item->tanggal_dikerjakan->startOfDay() : $tanggalSekarang;

        // Hitung umur dalam hari
        $item->umur = round($item->tanggal_pengaduan->diffInDays($tanggalAkhir));

        return $item;
    });

    return view('pengguna', compact('pengaduan'));
}

    // Fungsi untuk menampilkan profil pengguna
    public function profil()
    {
        $user = Auth::user();  // Mengambil data pengguna yang sedang login

        // Ambil data pengaduan berdasarkan user yang login
        $pengaduan = Pengaduan::where('user_id', $user->id)->get();

        return view('profil', compact('user', 'pengaduan'));
    }

    public function daftarPengaduan()
{
    $pengaduan = Pengaduan::where('user_id', auth()->user()->id)
        ->where('status', '!=', 'SELESAI')
        ->get();

    return view('pengguna', compact('pengaduan'));
}

public function updateStatus(Request $request, $id)
{
    $pengaduan = Pengaduan::findOrFail($id);
    $pengaduan->status = $request->status;

    if ($pengaduan->status == 'selesai') {
        // Bisa juga memindahkan data ke tabel riwayat jika diperlukan
        $pengaduan->delete(); // Hapus pengaduan
    }
    $pengaduan->save();

    return redirect()->route('pengguna')->with('success', 'Status pengaduan telah diperbarui');
}

public function daftar()
{
    // Ambil semua pengaduan yang milik pengguna dengan status selain 'SELESAI'
    $pengaduan = Pengaduan::where('user_id', auth()->user()->id)
        ->where('status', '!=', 'selesai')
        ->get();

    return view('pengguna', compact('pengaduan'));
}


}
