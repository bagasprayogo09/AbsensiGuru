<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // Menampilkan semua data absensi
    public function index()
    {
        $absensis = Absensi::all();
        return view('admin.absensi.index', compact('absensis'));
    }

    // Menampilkan form tambah absensi
    public function create()
    {
        return view('admin.absensi.create', [
            'gurus' => Guru::all(),
            'jadwals' => Jadwal::all(),
        ]);
    }

    // Menyimpan data absensi baru
    public function store(StoreAbsensiRequest $request)
{
    // Validasi data
    $validatedData = $request->validated();

    // Ambil jadwal berdasarkan jadwal_id
    $jadwal = Jadwal::find($validatedData['jadwal_id']);

    // Pastikan jadwal ditemukan dan ambil kelasnya
    if (!$jadwal) {
        return redirect()->route('admin.absensi.create')->with('error', 'Jadwal tidak ditemukan.');
    }

    // Simpan absensi baru
    $validatedData['foto_keluar'] = $this->handleFileUpload($request);  // Mengelola foto keluar jika ada
    $validatedData['kelas'] = $jadwal->kelas;  // Menambahkan kelas dari jadwal yang dipilih

    Absensi::create($validatedData);

    return redirect()->route('admin.absensi.index')->with('success', 'Data absensi berhasil ditambahkan');
}


    // Menampilkan detail absensi
    public function show(Absensi $absensi)
    {
        return view('admin.absensi.show', compact('absensi'));
    }

    // Menampilkan form edit absensi
    public function edit(Absensi $absensi)
    {
        return view('admin.absensi.edit', [
            'absensi' => $absensi,
            'gurus' => Guru::all(),
            'jadwals' => Jadwal::all(),
        ]);
    }

    // Memperbarui data absensi
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        $validatedData = $request->validated();
        $validatedData['foto_keluar'] = $this->handleFileUpload($request, $absensi);

        $absensi->update($validatedData);

        return redirect()->route('absensis.index')->with('success', 'Data absensi berhasil diperbarui');
    }

    // Menghapus data absensi
    public function destroy(Absensi $absensi)
    {
        $this->deleteFile($absensi->foto_keluar);
        $absensi->delete();

        return redirect()->route('admin.absensi.index')->with('success', 'Data absensi berhasil dihapus');
    }

    // Mengelola upload file
    private function handleFileUpload(Request $request, Absensi $absensi = null)
    {
        if ($request->hasFile('foto_keluar')) {
            if ($absensi && $absensi->foto_keluar) {
                $this->deleteFile($absensi->foto_keluar);
            }
            return $request->file('foto_keluar')->store('absensi_photos', 'public');
        }
        return null;
    }

    // Menghapus file
    private function deleteFile($filePath)
    {
        if ($filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }
// Menampilkan halaman laporan
public function report(Request $request)
{
    // Query untuk laporan
    $query = Absensi::query();

    // Filter berdasarkan rentang tanggal (WAJIB)
    $query->whereBetween('tanggal', [
        $request->start_date ?? date('Y-m-d'),
        $request->end_date ?? date('Y-m-d')
    ]);

    // Filter berdasarkan guru (opsional)
    if ($request->filled('guru_id')) {
        $query->where('guru_id', $request->guru_id); }

    // Filter berdasarkan status (opsional)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Ambil data dengan relasi guru
    $absensis = $query->with('guru')->get();

    return view('admin.absensi.report', [
        'gurus' => Guru::all(),
        'status_options' => [
            'hadir' => 'Hadir',
            'izin' => 'Izin',
            'sakit' => 'Sakit',
            'alfa' => 'Alfa'
        ],
        'absensis' => $absensis
    ]);
}

// Generate laporan
public function generateReport(Request $request)
{
    // Validasi input
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'guru_id' => 'nullable|exists:gurus,id',
        'status' => 'nullable|in:hadir,izin,sakit,alfa'
    ]);

    // Query untuk laporan
    $query = Absensi::query();

    // Filter berdasarkan rentang tanggal (WAJIB)
    $query->whereBetween('tanggal', [
        $request->start_date,
        $request->end_date
    ]);

    // Filter berdasarkan guru (opsional)
    if ($request->filled('guru_id')) {
        $query->where('guru_id', $request->guru_id);
    }

    // Filter berdasarkan status (opsional)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Ambil data dengan relasi guru
    $absensis = $query->with('guru')->get();

    // Hitung statistik
    $statistik = [
        'total' => $absensis->count(),
        'hadir' => $absensis->where('status', 'hadir')->count(),
        'izin' => $absensis->where('status', 'izin')->count(),
        'sakit' => $absensis->where('status', 'sakit')->count(),
        'alfa' => $absensis->where('status', 'alfa')->count(),
    ];

    // Generate PDF
    $pdf = PDF::loadView('admin.absensi.report_pdf', [
        'absensis' => $absensis,
        'statistik' => $statistik,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date
    ])->setPaper('a4', 'landscape')
        ->setOptions(['isRemoteEnabled' => true]);
    // Download PDF
    return $pdf->stream('Laporan_Absensi_' . $request->start_date . '_' . $request->end_date . '.pdf');
}
}
