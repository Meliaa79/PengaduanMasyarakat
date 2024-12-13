<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Pengaduan;
use App\Models\TambahWarga;
use Carbon\Carbon; // Import Carbon untuk menghitung selisih tanggal

class UserFormController extends Controller
{
    public function create()
    {
        // Menampilkan halaman form pengaduan
        return view('userform');
    }

    public function store(Request $request)
    {
        Log::debug('Form data received:', $request->all());
    
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'judul_pengaduan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'alamat' => 'required|string',
            'tanggal_pengaduan' => 'required|date',
        ]);
    
        // Menghitung umur pengaduan berdasarkan tanggal pengaduan
        $tanggal_pengaduan = Carbon::parse($request->tanggal_pengaduan);
        $umur = $tanggal_pengaduan->diffInDays(Carbon::now());
    
        // Debug log untuk melihat data sebelum disimpan
        Log::debug('Data yang akan disimpan:', [
            'nama' => $request->nama,
            'tanggal_pengaduan' => $request->tanggal_pengaduan,
            'umur' => $umur,
            'status' => 'belum_dikerjakan',
        ]);
    
        // Simpan pengaduan ke database
        Pengaduan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'judul_pengaduan' => $request->judul_pengaduan,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'tanggal_pengaduan' => $request->tanggal_pengaduan,
            'umur' => $umur,
            'status' => 'belum_dikerjakan',
        ]);
    
        return redirect()->route('userform.create')->with('success', 'Pengaduan berhasil dikirim');
    }

    public function showForm()
{
    // Mendapatkan nama pengguna dari session
    $user = session('user'); // Mengambil nama pengguna yang login
    
    // Mengambil data pengguna dari tabel tambahwarga berdasarkan nama
    $dataUser = TambahWarga::where('nama', $user)->first();

    // Mengirim data pengguna ke view
    return view('userform', compact('dataUser'));
}
// Misalnya di UserFormController
public function profile()
{
    // Ambil nama user dari session
    $user = session('user');  // Pastikan session 'user' sudah diset sebelumnya

    // Ambil data user berdasarkan nama dari tabel TambahWarga
    $dataUser = TambahWarga::where('nama', $user)->first();

    // Ambil data pengaduan jika ada (misalnya berdasarkan nama)
    $pengaduan = Pengaduan::where('nama', $dataUser->nama)->get();

    // Kirim data ke view
    return view('profile', compact('dataUser', 'pengaduan'));
}


}
