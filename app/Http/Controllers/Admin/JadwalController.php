<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;  //Model untuk jadwal
use App\Models\MataPelajaran; // Model untuk guru
use App\Models\User; // Model untuk guru
use Illuminate\Http\Request;

class JadwalController extends Controller
{
     // Menampilkan daftar jadwal
     public function index()
     {
        $guru = User::where('role','guru')->get(); // Ambil data guru
        $jadwals = Jadwal::all();
        return view('admin.jadwal.index', compact('jadwals'));
     }

     // Menampilkan form untuk menambah jadwal
     public function create()
     {
         $mataPelajarans = MataPelajaran::all(); // Ambil semua mata pelajaran
         $gurus = User::where('role', 'guru')->get(); // Ambil semua guru
         return view('admin.jadwal.create', compact('mataPelajarans', 'gurus'));
     }

     // Menyimpan jadwal baru
     public function store(Request $request)
     {
         $request->validate([
             'hari' => 'required|string|max:255',
             'jumlah_jam' => 'required|integer',
             'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
             'guru_id' => 'required|exists:users,id',
         ]);

         Jadwal::create($request->all());
         return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
     }

     // Menampilkan form untuk mengedit jadwal
     public function edit(Jadwal $jadwal)
     {
         return view('admin.jadwal.edit', compact('jadwal'));
     }

     // Memperbarui jadwal
     public function update(Request $request, Jadwal $jadwal)
     {
         $request->validate([
             'hari' => 'required|string|max:255',
             'mata_pelajaran' => 'required|string|max:255',
         ]);

         $jadwal->update($request->all());
         return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
     }

     // Menghapus jadwal
     public function destroy(Jadwal $jadwal)
     {
         $jadwal->delete();
         return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
     }
}
