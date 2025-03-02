<x-guruapp-layout>
    <div class="container">
        <h2 class="text-black font-bold mb-4">Edit Data</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('guru.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="block">Nama</label>
                <input type="text" name="name" class="border rounded p-2 w-full" value="{{ old('name', $guru->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" class="border rounded p-2 w-full" value="{{ old('email', $guru->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="pendidikan_terakhir" class="block">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" class="border rounded p-2 w-full" value="{{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) }}" required>
            </div>

            <div class="mb-3">
                <label for="jurusan" class="block">Jurusan</label>
                <input type="text" name="jurusan" class="border rounded p-2 w-full" value="{{ old('jurusan', $guru->jurusan) }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="block">Alamat</label>
                <input type="text" name="alamat" class="border rounded p-2 w-full" value="{{ old('alamat', $guru->alamat) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="block">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="border rounded p-2 w-full">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="border rounded p-2 w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </form>
    </div>
</x-guruapp-layout>
