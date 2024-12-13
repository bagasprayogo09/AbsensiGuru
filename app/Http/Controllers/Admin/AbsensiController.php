<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; // Import Carbon
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $guru = User::where('role','guru')->get(); // Ambil data guru
        $absensis = Absensi::all();
        return view('admin.absensi.index', compact('guru','absensis')); // Kirim data ke view
    }

//     public function create()
//     {
//         $users = User::all(); // Ambil semua data guru
//         return view('admin.absensi.create', compact('users'));
//     }

//     public function store(Request $request)
// {
//     // Validasi input yang diperlukan
//     $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'tanggal' => 'required|date',
//         'status' => 'required|in:hadir,tidak_hadir,izin',
//         // Hapus validasi jam_masuk karena tidak ada input untuk itu
//         'jam_keluar' => 'nullable|date_format:H:i', // Validasi jam keluar (nullable)
//     ]);

//     // Simpan data absensi dengan waktu yang disesuaikan ke zona waktu Jakarta
//     Absensi::create([
//         'user_id' => Auth::id(),
//         'tanggal' => Carbon::now('Asia/Jakarta')->toDateString(), // Menggunakan zona waktu Jakarta
//         'status' => $request->status, // Menggunakan status dari request
//         // 'jam_masuk' => Carbon::now('Asia/Jakarta')->toTimeString(), // Menyimpan jam masuk
//         'jam_keluar' => null, // Jam keluar diatur null saat absen
//     ]);

//     return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil ditambahkan.');
// }

    public function edit($id)
    {
        $absensis = Absensi::find($id); // Ambil data absensi berdasarkan id
        $users = User::all(); // Ambil semua data guru untuk dropdown

        return view('admin.absensi.edit', compact('absensis', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,tidak_hadir,izin',
            'jam_masuk' => 'nullable|date_format:H:i', // Validasi jam masuk
            'jam_keluar' => 'nullable|date_format:H:i', // Validasi jam keluar (nullable)
        ]);

        $absensis = Absensi::findOrFail($id);

        // Hanya memperbarui tanggal, status, jam masuk, dan jam keluar
        $absensis->tanggal = Carbon::parse($request->tanggal)->timezone('Asia/Jakarta')->format('Y-m-d');
        $absensis->status = $request->status;
        $absensis->jam_masuk = $request->jam_masuk ? Carbon::parse($request->jam_masuk)->timezone('Asia/Jakarta')->format('H:i:s') : null;
        $absensis->jam_keluar = $request->jam_keluar ? Carbon::parse($request->jam_keluar)->timezone('Asia/Jakarta')->format('H:i:s') : null; // Update jam keluar

        // Simpan perubahan ke database
        $absensis->save();

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    public function laporanAbsensi(Request $request)
{
    $query = Absensi::query();

if ($request->filled('start_date')) {
    $query->where('tanggal', '>=', $request->start_date);
}

if ($request->filled('end_date')) {
    $query->where('tanggal', '<=', $request->end_date);
}

if ($request->filled('status')) {
    $query->where('status', $request->status);
}

if ($request->filled('nama')) {
    $query->whereHas('user', function($q) use ($request) {
        $q->where('name', 'like', '%' . $request->nama . '%');
    });
}

if ($request->filled('user_id')) {
    $query->where('user_id', $request->user_id);
}

$absensis = $query->get();

    // Ambil data absensi sesuai filter
    $absensis = $query->get();

    return view('admin.absensi.laporan', compact('absensis'));
}

public function exportPDF(Request $request)
{
    $query = Absensi::query();

    // Filter berdasarkan rentang tanggal
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    }

    // Filter berdasarkan status
    if ($request->filled('status') && $request->status !== '') {
        $query->where('status', $request->status);
    }

    // Filter berdasarkan user_id jika ada
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    // Ambil data absensi yang sudah difilter
    $absensis = $query->get();

    // Siapkan data untuk tampilan PDF
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    // Buat PDF
    $pdf = PDF::loadView('admin.absensi.pdf', compact('absensis', 'start_date', 'end_date'));
    return $pdf->download('data_absensi.pdf');
}
}
