<?php

namespace App\Http\Controllers;

use App\Models\TambahWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahDataWargaController extends Controller
{
    // Menampilkan form tambah data warga
    public function index() {
        return view('tambahdatawarga'); // Menampilkan form tambah warga
    }
    
    public function store(Request $request) {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'telepon' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);
    
        // Menyimpan data
        $warga = new TambahWarga;
        $warga->nama = $validated['nama'];
        $warga->nik = $validated['nik'];
        $warga->telepon = $validated['telepon'];
        $warga->password = Hash::make($validated['password']);
        $warga->save();
    
        return redirect()->route('datawarga.index')->with('success', 'Data warga berhasil ditambahkan');
    }
    
}
