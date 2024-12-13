<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Jadwal Mengajar') }}
        </h2>
    </x-slot>

    <!-- Pesan sukses -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            confirmButtonText: 'Tutup',
        });
    </script>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md mb-4">
            Tambah Jadwal
        </a>
        <h2 class="text-xl font-bold mb-4">Jadwal Mengajar Guru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($jadwals as $jadwal)
                <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                    <p class="text-sm text-gray-600">Hari: {{ ucfirst($jadwal->hari) }}</p>
                    <p class="text-sm font-bold text-gray-700">Mata Pelajaran: {{ $jadwal->mataPelajaran->nama_pelajaran }}</p>
                    <p class="text-sm text-gray-600">Guru: {{ $jadwal->guru->name }}</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            Edit
                        </a>
                        <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full text-gray-600">Tidak ada jadwal mengajar.</p>
            @endforelse
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>
</x-app-layout>
