<?php

namespace App\Http\Controllers;

use App\Models\TambahPetugas;
use Illuminate\Http\Request;

class TambahDataPetugasController extends Controller
{
    public function index()
    {
        return view('tambahdatapetugas');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        // Menyimpan data ke tabel
        TambahPetugas::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke halaman data petugas setelah berhasil
        return redirect('/petugas');
    }

    public function show()
    {
        // Mengambil semua data petugas dari tabel 'tambahpetugas'
        $petugas = TambahPetugas::all();

        // Mengirim data petugas ke view 'datawarga'
        return view('petugas', compact('petugas'));
    }

    public function destroy($id)
    {
        // Cari petugas berdasarkan ID
        $petugas = TambahPetugas::findOrFail($id);

        // Hapus petugas
        $petugas->delete();

        // Redirect kembali ke halaman daftar petugas dengan pesan sukses
        return redirect('/petugas')->with('success', 'Data petugas berhasil dihapus');
    }
}
