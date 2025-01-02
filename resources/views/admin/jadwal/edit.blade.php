<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.jadwal.update', $jadwal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="guru_id" class="block text-gray-700">Guru</label>
                            <select name="guru_id" id="guru_id" class="form-select mt-1 block w-full" required>
                                <option value="">Pilih Guru</option>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}" {{ $jadwal->guru_id == $guru->id ? 'selected' : '' }}>{{ $guru->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="mata_pelajaran_id" class="block text-gray-700">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-select mt-1 block w-full" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($mataPelajarans as $mataPelajaran)
                                    <option value="{{ $mataPelajaran->id }}" {{ $jadwal->mata_pelajaran_id == $mataPelajaran->id ? 'selected' : '' }}>{{ $mataPelajaran->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="hari" class="block text-gray-700">Hari</label>
                            <input type="text" name="hari" id="hari" class="form-input mt-1 block w-full" value="{{ $jadwal->hari }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="jam_mulai" class="block text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-input mt-1 block w-full" value="{{ $jadwal->jam_mulai }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="jam_selesai" class="block text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-input mt-1 block w-full" value="{{ $jadwal->jam_selesai }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
