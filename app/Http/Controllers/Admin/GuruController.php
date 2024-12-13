<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Menampilkan daftar guru
    public function index()
{
    $users = User::where('role', 'guru')->with('jadwal')->get(); // Eager load jadwal dan mataPelajaran
    return view('admin.guru.index', compact('users'));
}

    public function create()
    {
        $mataPelajaran = MataPelajaran::all(); // Ambil semua mata pelajaran
        return view('admin.guru.create', compact('mataPelajaran'));
    }

    // Menyimpan data guru baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'hari' => 'required|array',
            // 'mata_pelajaran_id' => 'required|array',
        ]);

        // Simpan data guru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'guru';
        $user->save();

        // Simpan jadwal mengajar
        // foreach ($request->hari as $key => $hari) {
        //     $mataPelajaranId = $request->mata_pelajaran_id[$key] ?? null;
        //     if ($mataPelajaranId) {
        //         $user->jadwals()->create([
        //             'hari' => $hari,
        //             'mata_pelajaran_id' => $mataPelajaranId,
        //             'jumlah_jam' => $request->jumlah_jam[$key], // Ambil jumlah jam dari input
        //         ]);
        //     }
        // }

        return redirect()->route('admin.guru.index')->with('success', 'Guru dan jadwal berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $mataPelajaran = MataPelajaran::all();
        $user->load('jadwals'); // Muat relasi jadwals untuk diedit
        return view('admin.guru.edit', compact('user', 'mataPelajaran'));
    }

    // Mengupdate data guru
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'hari' => 'required|array',
            'mata_pelajaran_id' => 'required|array',
        ]);

        // Update data guru
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Update jadwal mengajar
        $user->jadwals()->delete(); // Hapus jadwal lama
        foreach ($request->hari as $key => $hari) {
            $mataPelajaranId = $request->mata_pelajaran_id[$key] ?? null;
            if ($mataPelajaranId) {
                $user->jadwals()->create([
                    'hari' => $hari,
                    'mata_pelajaran_id' => $mataPelajaranId,
                    'jumlah_jam' => $request->jumlah_jam[$key], // Ambil jumlah jam dari input
                ]);
            }
        }

        return redirect()->route('admin.guru.index')->with('success', 'Guru dan jadwal berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}
