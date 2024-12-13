<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DataLaporanController;
use App\Http\Controllers\LaporanAkhirController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\UserFormController;
use App\Http\Controllers\RiwayatLaporanUserController;
use App\Http\Controllers\AdminDasboardController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\TambahDataWargaController;
use App\Http\Controllers\TambahDataPetugasController;
use App\Http\Controllers\PengaduanController;


use Illuminate\Support\Facades\Route;



Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
// Halaman untuk menampilkan form edit
Route::get('/editdatapetugas/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
Route::put('/petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
Route::get('/tambahdatapetugas', [PetugasController::class, 'create'])->name('tambahdatapetugas');
Route::put('pengaduan/update-status/{id}', [PengaduanController::class, 'updateStatus'])->name('update-status');
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');

Route::get('/datalaporan', [DataLaporanController::class, 'index']);

Route::get('/laporanakhir', [LaporanAkhirController::class, 'index']);

Route::get('/landing', [LandingController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);
Route::get('home', function () {
    // Periksa apakah pengguna sudah login dengan melihat session
    if (session()->has('pengguna')) {
        return view('home'); // Ganti dengan halaman yang sesuai
    }
    return redirect('login'); // Jika belum login, arahkan ke login
});

Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
Route::get('pengguna', function () {
    // Periksa apakah pengguna sudah login dengan melihat session
    if (session()->has('user')) {
        $user = session('user'); // Ambil data pengguna dari session
        return view('pengguna', compact('user')); // Kirim data pengguna ke view
    }
    return redirect('login'); // Jika belum login, arahkan ke login
});

Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');


Route::get('/userform', [UserFormController::class, 'index']);

Route::get('/riwayatlaporanuser', [RiwayatLaporanUserController::class, 'index']);

Route::get('/admindashboard', [AdminDasboardController::class, 'index']);

Route::get('/verifikasi', [VerifikasiController::class, 'index']);

Route::get('/datawarga', [DataWargaController::class, 'index'])->name('datawarga');
Route::resource('datawarga', DataWargaController::class);
Route::get('/editdatawarga/{id}', [DataWargaController::class, 'edit'])->name('warga.edit');
Route::put('/updatewarga/{id}', [DataWargaController::class, 'update'])->name('warga.update');
Route::get('/tambahdatawarga', [TambahDataWargaController::class, 'index'])->name('tambahdatawarga.create');
Route::post('/tambahdatawarga', [TambahDataWargaController::class, 'store'])->name('tambahdatawarga.store');; // Route untuk simpan data

Route::get('/hash-old-passwords', function () {
    $users = \App\Models\TambahWarga::all();

    foreach ($users as $user) {
        if (!Hash::needsRehash($user->password)) {
            continue; // Skip jika password sudah di-hash
        }
        $user->password = Hash::make($user->password);
        $user->save();
    }

    return "Semua password berhasil di-hash!";
});


// Route untuk menampilkan riwayat pengaduan pengguna
Route::get('/riwayatlaporanuser', [PengaduanController::class, 'index'])->name('riwayatlaporanuser.index');
// Route untuk menampilkan form pengaduan dan menyimpannya

// Route untuk riwayat pengaduan pengguna
Route::get('/riwayatlaporanuser', [PengaduanController::class, 'index'])->name('riwayatlaporanuser.index');
Route::get('/userform', [UserFormController::class, 'showForm'])->name('userform');

Route::get('/userform', [PengaduanController::class, 'create'])->name('userform.create');
Route::post('/userform', [PengaduanController::class, 'store'])->name('userform');
Route::post('/userform', [PengaduanController::class, 'store'])->name('userform.store');
Route::get('/userform', [PengaduanController::class, 'create'])->name('userform');
Route::get('/userform', [PengaduanController::class, 'index'])->name('userform');

Route::get('/admindashboard', [AdminDasboardController::class, 'index']);
// Route::get('/admindashboard', [AdminDasboardController::class, 'getGrafikData']);
Route::get('/admindashboard', [PengaduanController::class, 'getGrafikData']);

Route::get('/verifikasi', [PengaduanController::class, 'verifikasi'])->name('verifikasi');
Route::post('/verifikasi/update/{id}', [PengaduanController::class, 'updateStatus'])->name('updatestatus');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/verifikasi', [PengaduanController::class, 'verifikasi'])->name('verifikasi');
Route::get('/verifikasi', [PengaduanController::class, 'index'])->name('verifikasi.index');
// Route::get('/admindashboard', [AdmindasboardController::class, 'getGrafikData']);
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');

Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
Route::post('/verifikasi/update/{id}', [VerifikasiController::class, 'updateStatus'])->name('verifikasi.update');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::patch('/petugas/update-status/{id}', [PetugasController::class, 'updateStatus'])->name('petugas.updateStatus');

Route::put('pengaduan/update/{id}', [PengaduanController::class, 'updateStatus']);
Route::put('/verifikasi/{id}/update', [PengaduanController::class, 'updateStatus'])->name('statusupdate');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/verifikasi', [PengaduanController::class, 'verifikasi'])->name('verifikasi');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/verifikasi', [PengaduanController::class, 'verifikasi'])->name('verifikasi');
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::put('/verifikasi/{id}', [VerifikasiController::class, 'updateStatus'])->name('verifikasi.update');
Route::get('/userform', [PengaduanController::class, 'create'])->name('userform');
Route::get('/userform', [PengaduanController::class, 'index'])->name('userform');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
// Route GET untuk menampilkan halaman verifikasi
Route::get('pengaduan/verifikasi', [PengaduanController::class, 'verifikasi'])->name('verifikasi');

// Jika ada aksi PUT, tambahkan route untuk update
Route::put('pengaduan/verifikasi/{id}', [PengaduanController::class, 'updateStatus'])->name('verifikasi.update');
Route::get('/riwayatlaporanuser', [PengaduanController::class, 'riwayatPengaduanUser'])->name('riwayatpengaduanuser');
Route::get('/riwayatlaporanuser', [RiwayatLaporanUserController::class, 'riwayatLaporanUser'])->name('riwayatlaporanuser');
Route::get('/pengaduan', [PengaduanController::class, 'index']);
Route::get('/riwayatlaporanuser', [PengaduanController::class, 'showRiwayatLaporanUser']);
Route::get('/riwayatlaporanuser', [PengaduanController::class, 'riwayatLaporanUser'])->name('riwayat.laporan');
