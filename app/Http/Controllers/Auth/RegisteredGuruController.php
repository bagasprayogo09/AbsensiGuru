<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredGuruController extends Controller
{
    /**
     * Tampilkan halaman registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke halaman login jika belum login
        }
        return view('auth.gururegister'); // Pastikan view ini ada
    }

    /**
     * Tangani proses registrasi Guru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gurus',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $guru = Guru::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($guru));

        Auth::guard('guru')->login($guru);

        return redirect(route('guru.dashboard', absolute: false));
    }
}
