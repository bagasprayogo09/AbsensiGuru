<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class GuruController extends Controller
{
    public function index()
    {
        return view('admin.guru.index', [
            'gurus' => Guru::all()
        ]);
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:gurus,email',
            'password' => 'required|string|min:8|confirmed',
            'pendidikan_terakhir' => 'required|string|max:225',
            'alamat' => 'required|string|max:225',
            'jurusan' => 'required|string|max:225' // Added validation for jurusan
        ]);

        // Hash password sebelum menyimpan
        $validatedData['password'] = Crypt::encryptString($validatedData['password']);
        Guru::create($validatedData);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function show(Guru $guru)
{
    // Decrypt password untuk ditampilkan
    $password = Crypt::decryptString($guru->password);

    return view('admin.guru.show', compact('guru', 'password'));
}

    // public function edit(Guru $guru)
    // {
    //     return view('admin.guru.edit', compact('guru'));
    // }

    // public function update(Request $request, Guru $guru)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:225',
    //         'email' => 'required|email|unique:gurus,email,'.$guru->id,
    //         'password' => 'nullable|string|min:8|confirmed',
    //         'pendidikan_terakhir' => 'required|string|max:225',
    //         'alamat' => 'required|string|max:225',
    //         'jurusan' => 'required|string|max:225' // Added validation for jurusan
    //     ]);

    //     // Hanya update password jika diisi
    //     if ($request->filled('password')) {
    //         $validatedData['password'] = Crypt::encryptString($request->password);
    //     } else {
    //         unset($validatedData['password']);
    //     }

    //     $guru->update($validatedData);

    //     return redirect()->route('admin.guru.index')
    //         ->with('success', 'Data guru berhasil diupdate');
    // }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}
