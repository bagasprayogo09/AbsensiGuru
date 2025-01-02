<?php

namespace App\Traits;

use Carbon\Carbon;

trait IndonesianDateTrait
{
    // Format tanggal Indonesia
    public function formatTanggalIndonesia($date = null, $format = 'full')
    {
        $date = $date ?? $this->created_at;
        $carbon = Carbon::parse($date);

        return match($format) {
            'full' => $carbon->translatedFormat('l, d F Y'),
            'date' => $carbon->translatedFormat('d F Y'),
            'time' => $carbon->translatedFormat('H:i:s'),
            'datetime' => $carbon->translatedFormat('l, d F Y H:i:s'),
            default => $carbon->translatedFormat('d F Y')
        };
    }

    // Nama hari dalam bahasa Indonesia
    public function getNamaHariAttribute()
    {
        return Carbon::now()->translatedFormat('l');
    }

    // Konversi waktu ke format Indonesia
    public function convertWaktuIndonesia($time)
    {
        return Carbon::parse($time)->setTimezone('Asia/Jakarta')->format('H:i');
    }

    // Mendapatkan tanggal hari ini dalam format Indonesia
    public function getTanggalHariIniAttribute()
    {
        return Carbon::now()->translatedFormat('d F Y');
    }

    // Helper untuk format rupiah
    public function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
