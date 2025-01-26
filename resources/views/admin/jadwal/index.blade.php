<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-black">
            {{ __('Daftar Jadwal') }}
        </h2>
    </x-slot>
                @if(session('success'))
                    <div class="alert alert-success shadow-lg mb-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
            <div class="mt-8">
                    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md mb-4">
                        Tambah Jadwal
                    </a>
                    <h2 class="text-xl font-bold mb-4 text-black">Jadwal Mengajar Guru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($jadwals as $jadwal)
                        <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                            <p class="text-sm text-black">Hari: {{ ucfirst($jadwal->hari) }}</p>
                            <p class="text-sm font-bold text-black">Mata Pelajaran: {{ $jadwal->mataPelajaran->nama }}</p>
                            <p class="text-sm text-black">Kelas: {{ $jadwal->kelas }}</p>
                            <p class="text-sm text-black">Jam: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                            <p class="text-sm text-black">Guru: {{ $jadwal->guru->name }}</p>
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
            </div>
            @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

</x-app-layout>
