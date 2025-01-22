<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal
    public function index()
    {
        $jadwals = Jadwal::with(['mataPelajaran', 'guru'])->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // Menampilkan form untuk menambah jadwal
    public function create()
    {
        $mataPelajarans = MataPelajaran::all();
        $gurus = Guru::all(); // Pastikan Anda memiliki model Guru
        return view('admin.jadwal.create', compact('mataPelajarans', 'gurus'));
    }

    // Menyimpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        // Cek apakah jam_mulai lebih awal dari jam_selesai
        if ($request->jam_mulai >= $request->jam_selesai) {
            return redirect()->back()->withErrors(['jam_selesai' => 'Jam selesai harus lebih besar dari jam mulai.']);
        }

        Jadwal::create($request->all());
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit jadwal
    public function edit(Jadwal $jadwal)
    {
        $mataPelajarans = MataPelajaran::all();
        $gurus = Guru::all();
        return view('admin.jadwal.edit', compact('jadwal', 'mataPelajarans', 'gurus'));
    }

    // Memperbarui jadwal yang ada
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        // Cek apakah jam_mulai lebih awal dari jam_selesai
        if ($request->jam_mulai >= $request->jam_selesai) {
            return redirect()->back()->withErrors(['jam_selesai' => 'Jam selesai harus lebih besar dari jam mulai.']);
        }

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
