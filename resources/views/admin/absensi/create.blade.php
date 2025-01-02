<x-app-layout>
    <div class="container mt-5" style="max-width: 800px; margin: auto; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center mb-4 text-primary" style="font-weight: bold; font-size: 2em;">Tambah Absensi</h1>

        <form action="{{ route('admin.absensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-4">
                <x-input-label for="guru_id" :value="__('Pilih Guru')" class="form-label" />
                <select id="guru_id" name="guru_id" class="form-control" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih nama guru yang akan diabsen.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="jadwal_id" :value="__('Pilih Jadwal')" class="form-label" />
                <select id="jadwal_id" name="jadwal_id" class="form-control" required>
                    <option value="">-- Pilih Jadwal --</option>
                    @foreach($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}">{{ $jadwal->hari}}</option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih jadwal yang sesuai.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="tanggal" :value="__('Tanggal')" class="form-label" />
                <input id="tanggal" type="date" name="tanggal" class="form-control" required />
                <small class="text-muted">Pilih tanggal absensi.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="jam_masuk" :value="__('Jam Masuk')" class="form-label" />
                <input id="jam_masuk" type="time" name="jam_masuk" class="form-control" />
                <small class="text-muted">Masukkan jam masuk (format HH:MM).</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="jam_keluar" :value="__('Jam Keluar')" class="form-label" />
                <input id="jam_keluar" type="time" name="jam_keluar" class="form-control" />
                <small class="text-muted">Masukkan jam keluar (format HH:MM).</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="status" :value="__('Status')" class="form-label" />
                <select id="status" name="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak_hadir">Tidak Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="terlambat">Terlambat</option>
                </select>
                <small class="text-muted">Pilih status absensi guru.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="keterangan" :value="__('Keterangan')" class="form-label" />
                <textarea id="keterangan" name="keterangan" class="form-control" rows="3"></textarea>
                <small class="text-muted">Masukkan keterangan tambahan jika ada.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="foto_keluar" :value="__('Foto Keluar')" class="form-label" />
                <input id="foto_keluar" type="file" name="foto_keluar" class="form-control" <small class="text-muted">Upload foto jika ada.</small>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-success w-full py-3 font-semibold text-white rounded-md" style="background-color: #28a745;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
