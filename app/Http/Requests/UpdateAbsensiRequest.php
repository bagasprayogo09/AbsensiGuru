<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAbsensiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hanya mengizinkan admin untuk melakukan update
        return Auth::check() && Auth::user(); // Memastikan pengguna terautentikasi dan adalah admin
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guru_id' => 'required|exists:gurus,id', // Memastikan guru_id ada di tabel gurus
            'jadwal_id' => 'required|exists:jadwals,id', // Memastikan jadwal_id ada di tabel jadwals
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,tidak_hadir,izin,terlambat',
            'foto_keluar' => 'nullable|image|max:2048', // Maksimal 2MB
            'keterangan' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'guru_id.required' => 'Guru harus dipilih',
            'guru_id.exists' => 'Guru yang dipilih tidak valid',
            'jadwal_id.required' => 'Jadwal harus dipilih',
            'jadwal_id.exists' => 'Jadwal yang dipilih tidak valid',
            'tanggal.required' => 'Tanggal harus diisi',
            'status.required' => 'Status absensi harus dipilih',
            'foto_keluar.image' => 'File yang diupload harus berupa gambar',
            'foto_keluar.max' => 'Ukuran gambar maksimal 2MB',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 500 karakter',
        ];
    }
}
