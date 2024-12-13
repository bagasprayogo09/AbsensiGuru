<x-app-layout>
    <div class="container mt-5" style="max-width: 800px; margin: auto; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center mb-4 text-primary" style="font-weight: bold; font-size: 2em;">Tambah Jadwal</h1>

        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf

            <!-- Hari -->
            <div class="form-group mb-4">
                <x-input-label for="hari" :value="__('Hari')" class="form-label" />
                <input id="hari" type="text" name="hari" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Masukkan hari" style="width: 100%;" />
                @error('hari')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Jam -->
            <div class="form-group mb-4">
                <x-input-label for="jumlah_jam" :value="__('Jumlah Jam')" class="form-label" />
                <input id="jumlah_jam" type="number" name="jumlah_jam" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Masukkan jumlah jam" style="width: 100%;" />
                @error('jumlah_jam')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Mata Pelajaran -->
            <div class="form-group mb-4">
                <x-input-label for="mata_pelajaran_id" :value="__('Pilih Mata Pelajaran')" class="form-label" />
                <select id="mata_pelajaran_id" name="mata_pelajaran_id" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required style="width: 100%;">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mataPelajarans as $mataPelajaran)
                        <option value="{{ $mataPelajaran->id }}">{{ $mataPelajaran->nama_pelajaran }}</option>
                    @endforeach
                </select>
                @error('mata_pelajaran_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Guru -->
            <div class="form-group mb-4">
                <x-input-label for="guru_id" :value=" __('Pilih Guru')" class="form-label" />
                <select id="guru_id" name="guru_id" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required style="width: 100%;">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
                @error('guru_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-success w-full py-3 font-semibold text-white rounded-md" style="background-color: #28a745;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
