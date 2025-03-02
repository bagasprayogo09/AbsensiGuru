<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Guru;

class GuruEditController extends Controller
{
    public function edit()
    {
        $guru = Auth::user();
        return view ('guru.edit', compact('guru'));
    }

    public function update(Request $request)
    {
        $guru = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gurus,email,' . $guru->id,
            'pendidikan_terakhir' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $guru->update([
            'name' => $request->name,
            'email' => $request->email,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'password' => $request->password ? Hash::make($request->password) : $guru->password,
        ]);

        return redirect()->route('guru.edit')->with('success', 'Profil berhasil diperbarui');
    }
}
