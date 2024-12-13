<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Http\Controllers\Carbon;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // Menampilkan form pengaduan
    public function create()
{
    // Cek apakah ada pengguna yang login
    if (auth()->check()) {
        // Ambil id pengguna yang login
        $pengaduan = Pengaduan::where('nama', auth()->user()->nama)->get();

        // Ambil pengaduan yang hanya berhubungan dengan pengguna yang login
        $pengaduan = Pengaduan::where('nama', session('nama'))->get();
    } else {
        // Jika tidak ada pengguna yang login, ambil semua pengaduan
        $pengaduan = Pengaduan::all();
    }

    // Kirim data pengaduan ke view
    return view('userform', ['pengaduan' => $pengaduan]);
}


    // Menyimpan pengaduan yang diisi oleh user
    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_pengaduan' => 'required|string',            
            'deskripsi' => 'required|string',
            'tanggal_pengaduan' => 'required|date',
        ]);
        // $pengaduan->nama = session('nama');


        // Menyimpan data pengaduan
        $pengaduan = new Pengaduan();
        $pengaduan->nama = $validated['nama'];
        $pengaduan->kategori_pengaduan = $validated['kategori_pengaduan'];
        $pengaduan->deskripsi = $validated['deskripsi'];
        $pengaduan->tanggal_pengaduan = $validated['tanggal_pengaduan'];
        // Menghitung umur berdasarkan tanggal pengaduan
        $pengaduan->umur = now()->diffInYears($validated['tanggal_pengaduan']);
        $pengaduan->save();

        // Ambil semua data pengaduan untuk ditampilkan di halaman userform
        $pengaduan = Pengaduan::all(); // Ambil semua pengaduan yang ada di database

        // Redirect dengan data pengaduan yang sudah disimpan
        return redirect()->route('userform')->with('success', 'Pengaduan berhasil dikirim.');
    }
    public function login(Request $request)
    {
        // Simpan nama pengguna ke dalam session
        $nama = $request->input('nama');
        dd($nama);
        session(['nama' => $nama]);

        return redirect()->route('userform');
    }


public function index()
{
  
    // Ambil pengaduan hanya untuk pengguna yang sedang login
    $nama = session('nama');
    if (!$nama) {
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
    }
    if ($nama === 'admin') {
        // Jika admin, ambil semua pengaduan dan urutkan berdasarkan tanggal_pengaduan terbaru
        $pengaduan = Pengaduan::orderBy('tanggal_pengaduan', 'desc')->paginate(10); // Menggunakan paginate(10)
    } else {
        // Jika bukan admin, ambil pengaduan untuk nama pengguna dan urutkan berdasarkan tanggal_pengaduan terbaru
        $pengaduan = Pengaduan::where('nama', $nama)->orderBy('tanggal_pengaduan', 'desc')->paginate(10);
    }

    return view('userform', compact('pengaduan'));

    // Data untuk Grafik Status Pengaduan
    $statusData = Pengaduan::selectRaw('status, COUNT(*) as jumlah')
        ->where('user_id', auth()->id())  // Pastikan hanya pengaduan pengguna yang sedang login
        ->groupBy('status')
        ->pluck('jumlah', 'status');

    // Data untuk Grafik Jumlah Pengaduan Per Bulan
    $bulanData = Pengaduan::selectRaw('MONTH(tanggal_pengaduan) as bulan, COUNT(*) as jumlah')
        ->whereNotNull('tanggal_pengaduan') // Hindari nilai null
        ->where('user_id', auth()->id())  // Pastikan hanya pengaduan pengguna yang sedang login
        ->groupBy('bulan')
        ->pluck('jumlah', 'bulan');

    // Format data bulan agar lengkap 1-12
    $bulanFormatted = [];
    for ($i = 1; $i <= 12; $i++) {
        $bulanFormatted[] = $bulanData[$i] ?? 0; // Default 0 jika tidak ada data
    }

    // Kirim data ke view
    return view('admindashboard', compact('statusData', 'bulanFormatted'));
}

    public function getGrafikData()
    {
        $statusData = Pengaduan::selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                // Format nama status agar lebih user-friendly
                return [
                    match ($item->status) {
                        'belum_dikerjakan' => 'Belum Dikerjakan',
                        'sedang_dikerjakan' => 'Sedang Dikerjakan',
                        'selesai' => 'Selesai',
                        default => 'Tidak Diketahui',
                    } => $item->jumlah
                ];
            });

        // Tambahkan status default jika belum ada data
        $statusDataArray = array_merge([
            'Belum Dikerjakan' => 0,
            'Sedang Dikerjakan' => 0,
            'Selesai Dikerjakan' => 0,
        ], $statusData->toArray());


        // Data jumlah pengaduan per bulan
        $bulanData = Pengaduan::selectRaw('MONTH(tanggal_pengaduan) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        // Format data bulan agar semua bulan ada (default 0 jika kosong)
        $bulanFormatted = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulanFormatted[] = $bulanData[$i] ?? 0;
        }

        // Kirim data ke view
        return view('admindashboard', compact('statusDataArray', 'bulanFormatted'));
    }


    public function verifikasi()
    {
        $pengaduan = Pengaduan::all(); // Ambil semua data pengaduan
        $petugas = Petugas::all();
        $pengaduan = Pengaduan::where('status', '<>', 'selesai')->paginate(10); // Contoh filter
        $kategori_pengaduan = Pengaduan::select('kategori_pengaduan')->distinct()->get();

        return view('verifikasi', compact('pengaduan', 'petugas', 'kategori_pengaduan'));
    }

    // Update status pengaduan
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:belum_dikerjakan,sedang_dikerjakan,selesai',
            'nama_petugas' => 'nullable|string',
            'tanggal_dikerjakan' => 'nullable|date',
        ]);
        
        // Cari pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        $tanggalPengaduan = \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan);
        if ($request->tanggal_dikerjakan) {
            $tanggalDikerjakan = \Carbon\Carbon::parse($request->tanggal_dikerjakan);
            $umur = $tanggalPengaduan->diffInDays($tanggalDikerjakan);
            \Log::info("Hitung umur dari {$tanggalPengaduan} ke {$tanggalDikerjakan}: {$umur}");
        } else {
            $umur = $tanggalPengaduan->diffInDays(now());
            \Log::info("Hitung umur dari {$tanggalPengaduan} ke hari ini: {$umur}");
        }

                $pengaduan->status = $validatedData['status'];
                $pengaduan->nama_petugas = $validatedData['nama_petugas'];
                $pengaduan->tanggal_dikerjakan = $validatedData['tanggal_dikerjakan'];

                // Update data pengaduan
                

                $pengaduan->save();

        return redirect()->route('verifikasi')->with('success', 'Data berhasil diperbarui.');
    }

  
    public function riwayatLaporanUser()
{
    // Ambil semua pengaduan yang statusnya 'selesai'
    $pengaduan = Pengaduan::where('status', 'selesai')->get();

    // Tentukan tanggal akhir (tanggal_dikerjakan atau tanggal sekarang)
    $tanggalSekarang = \Carbon\Carbon::now();

    // Loop untuk setiap pengaduan dan hitung umur
    foreach ($pengaduan as $item) {
        // Tentukan tanggal akhir pengaduan, jika ada tanggal dikerjakan
        $tanggalAkhir = $item->tanggal_dikerjakan ? \Carbon\Carbon::parse($item->tanggal_dikerjakan)->startOfDay() : $tanggalSekarang;

        // Hitung umur dalam hari dan simpan pada atribut umur
        $item->umur = $item->tanggal_pengaduan ? $item->tanggal_pengaduan->diffInDays($tanggalAkhir) : 0;
    }

    // Kirim data ke view riwayatlaporanuser
    return view('userform', compact('pengaduan'));
}



public function showRiwayatLaporanUser()
{
    // Mengambil data pengaduan yang sudah ditutup atau sesuai dengan kondisi yang diinginkan
    $pengaduan = Pengaduan::where('status', 'closed')->get(); // Misalnya, mengambil pengaduan yang statusnya 'closed'

    // Mengirim data ke view
    return view('userform', compact('pengaduan')); // Pastikan view sesuai
}

public function halamanPengguna()
{
    // Mengambil pengaduan yang statusnya selain 'selesai'
    $pengaduan = Pengaduan::where('user_id', auth()->user()->id);
    $pengaduan = Pengaduan::paginate(10)
    ->get();
    return view('userform', compact('pengaduan'));
}


}
