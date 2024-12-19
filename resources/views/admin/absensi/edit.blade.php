<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Absensi') }}
        </h2>
    </x-slot>

    <div class="container mt-4 p-6 bg-base-200 rounded-lg shadow-md">
        <form action="{{ route('admin.absensi.update', $absensis->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-control mb-4">
                <label for="nama_guru" class="label">
                    <span class="label-text">Nama Guru</span>
                </label>
                <input type="text" class="input input-bordered" id="nama_guru" name="nama_guru" value="{{ $absensis->user->name }}" readonly>
            </div>

            <div class="form-control mb-4">
                <label for="tanggal" class="label">
                    <span class="label-text">Tanggal</span>
                </label>
                <input type="date" class="input input-bordered" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($absensis->tanggal)->format('Y-m-d')) }}" required>
            </div>

            <div class="form-control mb-4">
                <label for="jam_masuk" class="label">
                    <span class="label-text">Jam Masuk</span>
                </label>
                <input type="time" class="input input-bordered" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk', $absensis->jam_masuk ? \Carbon\Carbon::parse($absensis->jam_masuk)->format('H:i') : '') }}">
            </div>

            <div class="form-control mb-4">
                <label for="foto_jam_keluar" class="label">
                    <span class="label-text">Foto Jam Keluar</span>
                </label>
                <input type="file" class="input input-bordered" id="foto_jam_keluar" name="foto_jam_keluar" accept="image/*">
                @if($absensis->foto_jam_keluar)
                    <div class="mt-2">
                        <img src="{{ Storage::url($absensis->foto_jam_keluar) }}" alt="Foto Jam Keluar" class="w-32 h-32 object-cover rounded">
                    </div>
                    <div class="mt-2">
                        <label class="label">
                            <input type="checkbox" name="delete_foto" value="1" class="checkbox">
                            <span class="label-text">Hapus Foto Jam Keluar</span>
                        </label>
                    </div>
                @endif
            </div>
            <div class="form-control mb-4">
                <label for="status" class="label">
                    <span class="label-text">Status</span>
                </label>
                <select class="select select-bordered" id="status" name="status" required>
                    <option value="hadir" {{ old('status', $absensis->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="tidak_hadir" {{ old('status', $absensis->status) == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    <option value="izin" {{ old('status', $absensis->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Absensi</button>
        </form>
    </div>
</x-app-layout>
