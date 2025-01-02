<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    // Menampilkan daftar mata pelajaran
    public function index()
    {
        $mataPelajarans = MataPelajaran::all();
        return view('admin.mata_pelajaran.index', compact('mataPelajarans'));
    }

    // Menampilkan form untuk menambahkan mata pelajaran baru
    public function create()
    {
        return view('admin.mata_pelajaran.create');
    }

    // Menyimpan mata pelajaran baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        MataPelajaran::create($validatedData);

        return redirect()->route('admin.mata_pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit mata pelajaran
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('admin.mata_pelajaran.edit', compact('mataPelajaran'));
    }

    // Memperbarui mata pelajaran
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $mataPelajaran->update($validatedData);

        return redirect()->route('admin.mata_pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diupdate');
    }

    // Menghapus mata pelajaran
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        return redirect()->route('admin.mata_pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil dihapus');
    }
}
