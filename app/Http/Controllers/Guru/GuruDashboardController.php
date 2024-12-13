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
        $today = Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd');
        $jadwals = Jadwal::where('guru_id', Auth::id())->with('mataPelajaran')->get();


        if (!$jadwals) {
            return redirect()->back()->with('error', 'Anda tidak memiliki jadwal mengajar hari ini!');
        }

        // Proses absensi
        $todayDate = Carbon::now('Asia/Jakarta')->toDateString();
        $currentTime = Carbon::now('Asia/Jakarta')->toTimeString();

        $absensi = Absensi::where('guru_id', Auth::id())->where('tanggal', $todayDate)->first();

        if (!$absensi) {
            Absensi::create([
                'guru_id' => Auth::id(),
                'tanggal' => $todayDate,
                'status' => 'hadir',
                'jam_masuk' => $currentTime,
            ]);
            return redirect()->back()->with('message', 'Absensi masuk berhasil dicatat!');
        } elseif (!$absensi->jam_keluar) {
            $absensi->update(['jam_keluar' => $currentTime]);
            return redirect()->back()->with('message', 'Absensi keluar berhasil dicatat!');
        }

        return redirect()->back()->with('message', 'Anda sudah melakukan absensi hari ini!');
    }



}

