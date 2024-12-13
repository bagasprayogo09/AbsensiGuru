<x-app-layout>
    <div class="container mt-5" style="max-width: 800px; margin: auto; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center mb-4 text-primary" style="font-weight: bold; font-size: 2em;">Tambah Absensi</h1>

        <form action="{{ route('admin.absensi.store') }}" method="POST">
            @csrf

            <div class="form-group mb-4">
                <x-input-label for="user_id" :value="__('Pilih Guru')" class="form-label" />
                <select id="user_id" name="user_id" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih nama guru yang akan diabsen.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="tanggal" :value="__('Tanggal')" class="form-label" />
                <input id="tanggal" type="date" name="tanggal" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required style="width: 100%;" />
                <small class="text-muted">Pilih tanggal absensi.</small>
            </div>

            <div class="form-group mb-4">
                <x-input-label for="status" :value="__('Status')" class="form-label" />
                <select id="status" name="status" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak_hadir">Tidak Hadir</option>
                    <option value="izin">Izin</option>
                </select>
                <small class="text-muted">Pilih status absensi guru.</small>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-success w-full py-3 font-semibold text-white rounded-md" style="background-color: #28a745;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
