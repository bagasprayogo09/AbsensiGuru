<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class HistoryAbsensiController extends Controller
{
    public function history()
    {
        // Pastikan guru sudah login
        if (!Auth::guard('guru')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil data absensi guru yang sedang login
        $absensis = Absensi::where('guru_id', Auth::guard('guru')->id())
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil data guru yang sedang login
        $guru = Auth::guard('guru')->user();

        return view('guru.riwayat_kehadiran', compact('absensis', 'guru'));
    }
}
