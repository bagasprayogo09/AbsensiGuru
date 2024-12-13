<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GuruProfileController extends Controller
{
    /**
     * Display the guru's profile form.
     */
    public function edit(Request $request): View
    {
        // Pastikan hanya role 'guru' yang dapat mengakses
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        return view('guru.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the guru's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('guru.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the guru's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
