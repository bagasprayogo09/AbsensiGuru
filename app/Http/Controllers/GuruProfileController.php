<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruUpdateRequest;
use App\Models\Guru; // Import the Guru model
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuruProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil guru.
     */
    public function edit(Request $request): View
    {
        $guru = $request->user(); // Assuming the user is a guru
        return view('guru.profile.edit', compact('guru'));
    }

    /**
     * Memperbarui informasi profil guru.
     */
    public function update(GuruUpdateRequest $request): RedirectResponse
    {
        $guru = $request->user(); // Retrieve the currently authenticated guru

        // Update guru data
        $guru->fill($request->validated());

        // If the email is changed, set email_verified_at to null
        if ($guru->isDirty('email')) {
            $guru->email_verified_at = null;
        }

        $guru->save(); // Save changes

        return redirect()->route('guru.profile.edit')->with('status', 'Profil berhasil diperbarui.');
    }

    /**
     * Menghapus akun guru.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $guru = $request->user(); // Retrieve the currently authenticated guru

        Auth::logout(); // Logout the guru

        $guru->delete(); // Delete the guru account

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the session token

        return redirect()->to('guru.login')->with('status', 'Akun Anda telah dihapus.');
    }
}
