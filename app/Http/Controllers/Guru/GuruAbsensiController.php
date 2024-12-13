<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruAbsensiController extends Controller
{
    public function history()
    {
        // Ambil histori absensi untuk guru yang sedang login
        $absensis = Absensi::where('guru_id', Auth::id())
            ->orderBy('tanggal', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->get();

        // Ambil informasi pengguna yang sedang login
        $user = Auth::user();

        // Mengembalikan tampilan dengan data absensi dan pengguna
        return view('guru.absensi.history', compact('absensis', 'user'));
    }
}
