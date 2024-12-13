<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Petugas::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && in_array($request->status, ['aktif', 'non-aktif'])) {
            $query->where('status', $request->status);
        }

        // Ambil data petugas sesuai filter
        $petugas = $query->get();

        return view('petugas', compact('petugas'));
    }


    public function create()
    {
        return view('tambahdatapetugas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
        ]);

        Petugas::create($request->all());

        return redirect('/petugas')->with('success', 'Data petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('editdatapetugas', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'status' => 'required|in:aktif,non-aktif',

        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->update($request->all());

        return redirect('/petugas')->with('success', 'Data petugas berhasil diubah.');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect('/petugas')->with('success', 'Data petugas berhasil dihapus.');
    }

    public function updateStatus($id)
    {
        $petugas = Petugas::find($id);

        if (!$petugas) {
            return redirect()->back()->with('error', 'Petugas tidak ditemukan');
        }

        // Ubah status menjadi non-aktif
        $petugas->status = 'non-aktif';
        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Status petugas berhasil diubah menjadi non-aktif');
    }

}
