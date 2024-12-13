<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Guru') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.guru.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <div class="mb-4">
                    <label for="jumlah_mengajar" class="block text-gray-700">Jumlah Mengajar</label>
                    <input type="number" id="jumlah_mengajar" name="jumlah_jam" value="{{ old('jumlah_jam', $user->jamMengajar->sum('jumlah_jam')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required min="0">
                </div>

                <div class="mb-4">
                    <label for="hari" class="block text-gray-700">Jadwal Mengajar</label>
                    <div id="jadwal-container">
                        @foreach ($user->jadwals as $key => $jadwal)
                        <div class="flex space-x-2 mb-2">
                            <input type="text" name="hari[]" value="{{ old('hari.' . $key, $jadwal->hari) }}" placeholder="Hari (contoh: Senin)" class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                            <input type="text" name="nama_pelajaran[]" value="{{ old('nama_pelajaran.' . $key, $jadwal->nama_pelajaran) }}" placeholder="Nama Pelajaran" class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-jadwal" class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">Tambah Jadwal</button>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password Baru</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Simpan</button>
                    <a href="{{ route('admin.guru.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200 ml-2">Kembali ke Daftar Guru</a>
                </div>
            </form>
        </div>
        <script>
            document.getElementById('add-jadwal').addEventListener('click', function () {
                const jadwalContainer = document.getElementById('jadwal-container');
                const jadwalTemplate = `
                    <div class="flex space-x-2 mb-2">
                        <input type="text" name="hari[]" placeholder="Hari (contoh: Senin)" class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <input type="text" name="nama_pelajaran[]" placeholder="Nama Pelajaran" class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    </div>
                `;
                jadwalContainer.insertAdjacentHTML('beforeend', jadwalTemplate);
            });
        </script>

    </div>
</x-app-layout>
