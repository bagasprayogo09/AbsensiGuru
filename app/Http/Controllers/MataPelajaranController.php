<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
Use App\Models\User;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    // Menampilkan daftar mata pelajaran
    public function index()
    {
        $mataPelajarans = MataPelajaran::all(); // Ambil semua data mata pelajaran
        return view('admin.matapelajaran.index', compact('mataPelajarans'));
    }

    // Menampilkan form tambah mata pelajaran
    public function create()
    {
        $gurus = User::where('role', 'guru')->get();
        return view('admin.matapelajaran.create', compact('gurus'));
    }

    // Menyimpan data mata pelajaran baru
    public function store(Request $request)
{
    $request->validate([
        'guru_id' => 'required|exists:users,id',
        'nama_pelajaran' => 'required|string|max:255',
    ]);

    MataPelajaran::create([
        'guru_id' => $request->guru_id,
        'nama_pelajaran' => $request->nama_pelajaran,
    ]);

    return redirect()->route('admin.matapelajaran.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
}

    // Menampilkan form edit mata pelajaran
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('admin.matapelajaran.edit', compact('mataPelajaran'));
    }

    // Memperbarui data mata pelajaran
    public function update(Request $request, MataPelajaran $mataPelajaran)
{
    $data = $request->validate([
        'nama_pelajaran' => 'required|string|max:255',
    ]);

    // Update the MataPelajaran instance with validated data
    $mataPelajaran->update($data);

    // Redirect with success message
    return redirect()->route('admin.matapelajaran.index')->with('success', 'Mata pelajaran berhasil diupdate.');
}

    // Menghapus mata pelajaran
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        return redirect()->route('admin.matapelajaran.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
