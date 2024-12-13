<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'guru')->get(); // Ambil semua guru
        $absensiData = Absensi::select('tanggal', 'status')->get(); // Ambil data absensi
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

    return view('admin.dashboard', compact('user', 'absensiData'));
    }
}
