<?php

namespace App\Http\Controllers;

use App\Models\TambahWarga; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk menggunakan Hash

class DataWargaController extends Controller
{
    // Menampilkan data warga
    public function index()
    {
        // Ambil semua data dari tabel tambahwarga
        $wargas = TambahWarga::all(); 

        // Kirim data ke view
        return view('datawarga', compact('wargas'));
    }

    // Menghapus data warga
    public function destroy($id)
    {
        // Cari data warga berdasarkan ID
        $warga = TambahWarga::findOrFail($id);
        
        // Hapus data warga
        $warga->delete();

        // Redirect ke halaman data warga dengan pesan sukses
        return redirect()->route('datawarga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    // Menampilkan form untuk mengedit data warga
    public function edit($id)
    {
        // Ambil data warga berdasarkan ID
        $warga = TambahWarga::findOrFail($id);

        // Kirim data ke view untuk di-edit
        return view('editdatawarga', compact('warga'));
    }

    // Update data warga
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'telepon' => 'required',
            'password' => 'required|min:6',
        ]);

        // Ambil data warga berdasarkan ID
        $warga = TambahWarga::findOrFail($id);

        // Update data warga
        $warga->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telepon' => $request->telepon,
            // Password di-hash sebelum disimpan
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman data warga dengan pesan sukses
        return redirect()->route('datawarga.index')->with('success', 'Data warga berhasil diperbarui.');
    }
}
