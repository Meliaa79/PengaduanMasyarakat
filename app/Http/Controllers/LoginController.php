<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Menampilkan halaman login
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil data pengguna dari tabel tambahwarga
        $user = DB::table('tambahwarga')->where('nama', $request->username)->first();

        // Cek apakah data ditemukan dan password sesuai
        if ($user && Hash::check($request->password, $user->password)) {
            // Jika login berhasil, simpan data pengguna ke session
            Session::put('id', $user->id); // Tambahkan ID pengguna ke session
            Session::put('nama', $user->nama); // Nama juga disimpan jika diperlukan
            Session::put('user', $user);

            return redirect('pengguna'); // Arahkan ke halaman pengguna
        } else {
            // Jika gagal, tampilkan SweetAlert error
            return back()->with('error', 'Nama atau Password tidak sesuai.');
        }
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('login');
    }
}
