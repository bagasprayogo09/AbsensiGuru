<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guru_id' => 'required|exists:gurus,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,tidak hadir,izin,terlambat',
            'foto_keluar' => 'nullable|image|max:2048',
            'keterangan' => 'nullable|string|max:500'
        ];
    }

    public function messages(): array
    {
        return [
            'guru_id.required' => 'Guru harus dipilih',
            'jadwal_id.required' => 'Jadwal harus dipilih',
            'tanggal.required' => 'Tanggal harus diisi',
            'status.required' => 'Status absensi harus dipilih',
        ];
    }
}
