<?php

namespace App\Http\Controllers;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {  


        // Mulai query untuk data pengaduan dengan pengurutan
        $query = Pengaduan::orderBy('tanggal_pengaduan', 'desc');
    
        // Ambil filter kategori dan waktu dari request
        $kategori = $request->input('kategori');
        $waktu = $request->input('waktu');
        
        // Filter berdasarkan waktu
        if ($waktu == 'minggu_ini') {
            // Filter untuk minggu ini
            $query->whereBetween('tanggal_pengaduan', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif (in_array($waktu, ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'])) {
            // Filter untuk bulan tertentu
            $month = Carbon::parse($waktu)->month;
            $query->whereMonth('tanggal_pengaduan', $month)
                  ->whereYear('tanggal_pengaduan', Carbon::now()->year);
        }
        
        // Filter berdasarkan kategori jika ada
        if ($kategori) {
            $query->where('kategori_pengaduan', $kategori);
        }
        
        $pengaduan = $query->paginate(10);
        

        // Ambil data dengan pagination setelah filter diterapkan
        $pengaduan = $query->paginate(10); // Jangan lupa panggil paginate

        // Ambil data petugas dari tabel petugas
        $petugas = Petugas::all();

        // Ambil kategori pengaduan yang unik
        $kategori_pengaduan = Pengaduan::select('kategori_pengaduan')->distinct()->get();

        return view('verifikasi', compact('pengaduan', 'petugas', 'kategori_pengaduan'));
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

        return redirect()->route('verifikasi')->with('success', 'Status pengaduan telah diperbarui');
    }

    public function verifikasi(Request $request)
    {
        $kategori_pengaduan = Pengaduan::all(); // Atau sesuai kebutuhan

        return view('verifikasi', compact('kategori_pengaduan'));
    }
}
