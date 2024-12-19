<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $todayDate = Carbon::now('Asia/Jakarta')->toDateString();
        $absensi = Absensi::where('guru_id', Auth::id())->get();
        $jadwals = Jadwal::where('guru_id', Auth::id())->with('mataPelajaran')->get();
        return view('guru.dashboard', compact('absensi', 'jadwals','todayDate'));
    }

    public function absen(Request $request)
    {
        // Validasi input foto jika ada
        $request->validate([
            'foto_jam_keluar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);

        $todayDate = Carbon::now('Asia/Jakarta')->toDateString();
        $currentTime = Carbon::now('Asia/Jakarta')->toTimeString();

        // Ambil absensi hari ini
        $absensi = Absensi::where('guru_id', Auth::id())->where('tanggal', $todayDate)->first();

        // Jika belum ada absensi untuk hari ini
        if (!$absensi) {
            Absensi::create([
                'guru_id' => Auth::id(),
                'tanggal' => $todayDate,
                'status' => 'hadir',
                'jam_masuk' => $currentTime,
            ]);
            return redirect()->back()->with('message', 'Absensi masuk berhasil dicatat!');
        } elseif (!$absensi->jam_keluar) {
            // Jika sudah absen masuk tetapi belum absen keluar
            $fotoPath = null;

            // Meng-upload foto jika ada
            if ($request->hasFile('foto_jam_keluar')) {
                $file = $request->file('foto_jam_keluar');
                $fotoPath = $file->store('foto_jam_keluar', 'public'); // Menyimpan foto di storage/app/public/foto_jam_keluar
            }

            // Update jam keluar dan foto
            $absensi->update([
                'jam_keluar' => $currentTime,
                'foto_jam_keluar' => $fotoPath, // Menyimpan path foto di database
            ]);

            return redirect()->back()->with('message', 'Absensi keluar berhasil dicatat!');
        }

        return redirect()->back()->with('message', 'Anda sudah melakukan absensi hari ini!');
    }



}

