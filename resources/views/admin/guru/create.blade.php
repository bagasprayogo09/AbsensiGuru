<x-app-layout>
    <div class="container mt-5" style="max-width: 800px; margin: auto; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center mb-4 text-primary" style="font-weight: bold; font-size: 2em;">Tambah Guru</h1>

        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="form-group mb-4">
                <x-input-label for="name" :value="__('Nama')" class="form-label" />
                <input id="name" type="text" name="name" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required autofocus placeholder="Masukkan nama guru" style="width: 100%;" />
            </div>

            <!-- Email -->
            <div class="form-group mb-4">
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <input id="email" type="email" name="email" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Masukkan email guru" style="width: 100%;" />
            </div>

            {{-- <!-- Mata Pelajaran -->
            <div class="form-group mb-4">
                <x-input-label for="mata_pelajaran" :value="__('Mata Pelajaran')" class="form-label" />
                <select id="mata_pelajaran" name="nama_pelajaran[]" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required style="width: 100%;" multiple>
                    @foreach ($mataPelajaran as $mataPelajaran)
                        <option value="{{ $mataPelajaran->id }}">{{ $mataPelajaran->nama_pelajaran }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Pilih satu atau lebih mata pelajaran.</small>
            </div>

            <!-- Hari Mengajar -->
            <div class="form-group mb-4">
                <x-input-label for="hari" :value="__('Hari Mengajar')" class="form-label" />
                <select id="hari" name="hari[]" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required style="width: 100%;" multiple>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
                <small class="form-text text-muted">Pilih satu atau lebih hari.</small>
            </div> --}}

            <!-- Password -->
            <div class="form-group mb-4">
                <x-input-label for="password" :value="__('Password')" class="form-label" />
                <input id="password" type="password" name="password" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Buat password" style="width: 100%;" />
            </div>

            <div class="form-group mb-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="form-label" />
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Konfirmasi password" style="width: 100%;" />
            </div>

            {{-- <!-- Jumlah Jam Per Mata Pelajaran -->
            <div class="form-group mb-4">
                <x-input-label for="jumlah_jam" :value="__('Jumlah Jam')" class="form-label" />
                <input id="jumlah_jam" type="number" name="jumlah_jam[]" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Jumlah jam mengajar" style="width: 100%;" />
                <small class="form-text text-muted">Isi jumlah jam untuk masing-masing mata pelajaran.</small>
            </div> --}}

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-success w-full py-3 font-semibold text-white rounded-md" style="background-color: #28a745;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
