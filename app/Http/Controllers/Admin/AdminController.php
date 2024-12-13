<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get(); // Ambil semua admin
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Enkripsi password
        $user->role = 'admin'; // Set role menjadi admin
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id); // Ambil admin berdasarkan ID
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Pastikan email unik, kecuali untuk admin yang sama
            'password' => 'nullable|string|min:8', // Password opsional
        ]);

        $admin = User::findOrFail($id); // Ambil admin berdasarkan ID
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password); // Enkripsi password jika diisi
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id); // Ambil admin berdasarkan ID
        $admin->delete(); // Hapus admin

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }


}
