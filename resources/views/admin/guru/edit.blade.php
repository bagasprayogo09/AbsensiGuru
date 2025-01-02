<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight">
            {{ __('Edit Data Guru') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg">
            {{-- Form Header --}}
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold text-black">
                    Formulir Edit Guru
                </h3>
            </div>

            {{-- Form Edit --}}
            <form
                action="{{ route('admin.guru.update', $guru) }}"
                method="POST"
                class="p-6 space-y-4"
            >
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-black"
                    >
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $guru->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300
                               shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                               text-black bg-white"
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-black"
                    >
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $guru->email) }}"
                        class="mt-1 block w-full rounded-md border-gray-300
                               shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                               text-black bg-white"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pendidikan Terakhir --}}
                <div>
                    <label
                        for="pendidikan_terakhir"
                        class="block text-sm font-medium text-black"
                    >
                        Pendidikan Terakhir
                    </label>
                    <select
                        name="pendidikan_terakhir"
                        id="pendidikan_terakhir"
                        class="mt-1 block w-full rounded-md border-gray-300
                               shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                               text-black bg-white"
                        required
                    >
                        <option value="">Pilih Pendidikan Terakhir</option>
                        <option value="SMA/SMK" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="D3" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="S1" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                    @error('pendidikan_terakhir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jurusan --}}
                <div>
                    <label
                        for="jurusan"
                        class="block text-sm font-medium text-black"
                    >
                        Jurusan
                    </label>
                    <input
                        type="text"
                        name="jurusan"
                        id="jurusan"
                        value="{{ old('jurusan', $guru->jurusan) }}"
                        class="mt-1 block w-full rounded-md border-gray-300
                               shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                               text-black bg-white"
                        required
                    >
                    @error('jurusan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password (Opsional) --}}
                <div>
                    <label
                        for="password"
                        class="block text-sm font-medium text-black"
                    >
                        Password Baru (Kosongkan jika tidak ingin mengubah)
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="mt-1 block w-full rounded-md border-gray-300
                               shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                               text-black bg-white"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-black"
                    >
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="mt-1 block w-full rounded-md border-gray-300
                               shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                               text-black bg-white"
                    >
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center justify-end space-x-4 pt-4">
                    {{-- Tombol Batal --}}
                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="btn btn-secondary text-black"
                    >
                        Batal
                    </a>

                    {{-- Tombol Simpan --}}
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
