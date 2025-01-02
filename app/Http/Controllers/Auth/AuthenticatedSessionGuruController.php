<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Pastikan untuk membuat request ini
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionGuruController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.gurulogin'); // Pastikan view ini ada
    }

    /**
     * Tangani proses login Guru.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Ambil kredensial dari request
        $credentials = $request->only('email', 'password');

        // Coba autentikasi dengan guard 'guru'
        if (!Auth::guard('guru')->attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'), // Pesan kesalahan jika autentikasi gagal
            ]);
        }

        // Regenerate session
        $request->session()->regenerate();

        // Redirect ke dashboard yang dimaksud
        return redirect()->intended(route('guru.dashboard', absolute: false));
    }

    /**
     * Tangani proses logout Guru.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('guru')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guru.login');
    }
}
