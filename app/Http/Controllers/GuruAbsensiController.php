<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


// Controller untuk mengelola absensi guru dalam sistem
class GuruAbsensiController extends Controller
{
    /**
     * Method untuk menampilkan dashboard guru
     * Fungsi ini melakukan:
     * - Mengambil tanggal hari ini
     * - Mengambil data absensi guru yang sedang login
     * - Mengambil jadwal guru yang sedang login
     * - Menampilkan view dashboard dengan data tersebut
     */
    public function dashboard()
    {
        // Dapatkan tanggal hari ini sesuai zona waktu Jakarta
        $todayDate = Carbon::now('Asia/Jakarta')->toDateString();

        // Ambil data absensi untuk guru yang sedang login
        $absensi = Absensi::where('guru_id', Auth::id())->get();

        // Ambil jadwal guru dengan relasi mata pelajaran
        $jadwals = Jadwal::where('guru_id', Auth::id())->with('mataPelajaran')->get();

        // Kembalikan view dashboard dengan data yang diambil
        return view('guru.dashboard', compact('absensi', 'jadwals', 'todayDate'));
    }

    /**
     * Method untuk melakukan proses absensi (masuk/keluar)
     * Fungsi ini menangani:
     * - Validasi input
     * - Proses absensi masuk
     * - Proses absensi keluar
     * - Penyimpanan foto (opsional)
     */
    public function absen(Request $request)
{
    $request->validate([
        'jadwal_id' => 'required|exists:jadwals,id',
        'foto_jam_keluar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $todayDate = Carbon::now('Asia/Jakarta')->toDateString();
    $currentTime = Carbon::now('Asia/Jakarta')->toTimeString();
    $jadwalId = $request->jadwal_id;

    // Cek apakah jadwal milik guru yang sedang login
    $jadwal = Jadwal::where('id', $jadwalId)
        ->where('guru_id', Auth::id())
        ->first();

    if (!$jadwal) {
        return redirect()->back()->with('error', 'Jadwal tidak ditemukan atau bukan milik Anda!');
    }

    // Cek apakah sudah ada absensi untuk jadwal ini hari ini
    $absensi = Absensi::where('guru_id', Auth::id())
        ->where('jadwal_id', $jadwalId)
        ->where('tanggal', $todayDate)
        ->first();

    // Cek apakah guru terlambat
    $jamMulaiJadwal = Carbon::parse($jadwal->jam_mulai);
    $statusMasuk = $currentTime > $jamMulaiJadwal->toTimeString() ? 'terlambat' : 'hadir';

    if (!$absensi) {
        Absensi::create([
            'guru_id' => Auth::id(),
            'jadwal_id' => $jadwalId,
            'tanggal' => $todayDate,
            'status_masuk' => $statusMasuk, // Bisa 'hadir' atau 'telat'
            'jam_masuk' => $currentTime,
        ]);

        return redirect()->back()->with('message', 'Absensi masuk berhasil dicatat dengan status: ' . $statusMasuk);
    } elseif (!$absensi->jam_keluar) {
        if (!$request->hasFile('foto_jam_keluar')) {
            return redirect()->back()->with('error', 'Anda harus mengunggah foto sebelum melakukan absensi keluar.');
        }

        $fotoPath = null;
        if ($request->file('foto_jam_keluar')->isValid()) {
            Log::info('File uploaded: ' . $request->file('foto_jam_keluar')->getClientOriginalName());
            $file = $request->file('foto_jam_keluar');
            $fotoPath = $file->store('foto_jam_keluar');
            $fotoPath = str_replace('public/', '', $fotoPath);
        } else {
            return redirect()->back()->with('error', 'File foto tidak valid.');
        }

        $absensi->update([
            'jam_keluar' => $currentTime,
            'status_keluar' => 'selesai',
            'foto_keluar' => $fotoPath,
        ]);

        return redirect()->back()->with('message', 'Absensi keluar berhasil dicatat!');
    }

    return redirect()->back()->with('message', 'Anda sudah menyelesaikan absensi untuk jadwal ini!');
}

}
