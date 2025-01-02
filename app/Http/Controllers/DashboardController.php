<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $guru = Guru::select('name', 'email')->get(); // Mengambil data guru yang dibutuhkan

        // Mengelompokkan data absensi
        $absensiData = Absensi::select('tanggal', 'status')
            ->get()
            ->groupBy('tanggal')
            ->map(function ($item) {
                return [
                    'hadir' => $item->where('status', 'hadir')->count(),
                    'tidak_hadir' => $item->where('status', 'tidak_hadir')->count(),
                    'izin' => $item->where('status', 'izin')->count(),
                ];
            });

        return view('dashboard', compact('guru', 'absensiData'));
    }
}
