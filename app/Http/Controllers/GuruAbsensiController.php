<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GuruAbsensiController extends Controller
{
    public function dashboard()
    {
        $todayDate = Carbon::now('Asia/Jakarta')->toDateString();
        $absensi = Absensi::where('guru_id', Auth::id())->get();
        $jadwals = Jadwal::where('guru_id', Auth::id())->with('mataPelajaran')->get();
        return view('guru.dashboard', compact('absensi', 'jadwals', 'todayDate'));
    }

    public function absen(Request $request)
{
    // Validasi input foto jika ada
    $request->validate([
        'jadwal_id' => 'required|exists:jadwals,id', // Validasi jadwal_id
        'foto_jam_keluar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
    ]);

    $todayDate = Carbon::now('Asia/Jakarta')->toDateString();
    $currentTime = Carbon::now('Asia/Jakarta')->toTimeString();
    $jadwalId = $request->jadwal_id;

    // Pastikan jadwal milik guru yang sedang login
    $jadwal = Jadwal::where('id', $jadwalId)
        ->where('guru_id', Auth::id())
        ->first();

    if (!$jadwal) {
        return redirect()->back()->with('error', 'Jadwal tidak ditemukan atau bukan milik Anda!');
    }

    // Cek apakah sudah absen untuk jadwal ini dan tanggal ini
    $absensi = Absensi::where('guru_id', Auth::id())
        ->where('jadwal_id', $jadwalId)
        ->where('tanggal', $todayDate)
        ->first();

    if (!$absensi) {
        // Jika belum absen, buat data absensi baru (absen masuk)
        Absensi::create([
            'guru_id' => Auth::id(),
            'jadwal_id' => $jadwalId,
            'tanggal' => $todayDate,
            'status_masuk' => 'hadir', // Sesuaikan dengan kolom di database
            'jam_masuk' => $currentTime,
        ]);

        return redirect()->back()->with('message', 'Absensi masuk berhasil dicatat untuk jadwal ini!');
    } elseif (!$absensi->jam_keluar) {
        // Jika sudah absen masuk tetapi belum absen keluar
        $fotoPath = null;

        // Meng-upload foto jika ada
        if ($request->hasFile('foto_jam_keluar')) {
            $file = $request->file('foto_jam_keluar');
            $fotoPath = $file->store('foto_jam_keluar', 'public');
        }

        // Update jam keluar dan foto
        $absensi->update([
            'jam_keluar' => $currentTime,
            'status_keluar' => 'selesai', // Tambahkan status keluar
            'foto_keluar' => $fotoPath,
        ]);

        return redirect()->back()->with('message', 'Absensi keluar berhasil dicatat untuk jadwal ini!');
    }

    return redirect()->back()->with('message', 'Anda sudah menyelesaikan absensi untuk jadwal ini!');
}

}
