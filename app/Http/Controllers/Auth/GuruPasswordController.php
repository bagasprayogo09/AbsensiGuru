<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class GuruPasswordController extends Controller
{
    /**
     * Update the guru's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Asumsikan Anda memiliki model Guru yang terhubung dengan pengguna
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect ke halaman guru/login setelah password berhasil diubah
        return redirect()->to('/guru/login')->with('status', 'password-updated');
    }
}
