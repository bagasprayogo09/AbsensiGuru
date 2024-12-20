<x-guruapp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <!-- Pesan sukses -->
    @if (session('message'))
        <div class="alert alert-success mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded relative">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Grid untuk Data Absensi dan Jadwal Mengajar -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <!-- Data Absensi -->
        {{-- <div>
            <h2 class="text-xl font-bold mb-4">Data Absensi</h2>
            <div class="grid grid-cols-1 gap-4">
                @forelse($absensi as $item)
                    <div class="card w-full bg-base-100 shadow-xl">
                        <figure>
                            <img src="{{ $item->foto_jam_keluar ? Storage::url($item->foto_jam_keluar) : 'https://via.placeholder.com/400' }}" alt="Gambar" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</h2>
                            <p>Jam Masuk: {{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</p>
                            <p>Jam Keluar: {{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '-' }}</p>
                            <p>Status: {{ ucfirst($item->status) }}</p>
                            <div class="card-actions justify-end">
                                <button class=" btn btn-primary">Detail</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-600">Tidak ada data absensi.</p>
                @endforelse
            </div>
        </div> --}}

        <!-- Jadwal Mengajar -->
        <div>
            <h2 class="text-xl font-bold mb-4">Jadwal Mengajar Anda</h2>
            <div class="grid grid-cols-1 gap-4">
                @forelse($jadwals as $jadwal)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title">Hari: {{ ucfirst($jadwal->hari) }}</h3>
                            <p class="text-sm font-bold text-gray-700">Mata Pelajaran: {{ $jadwal->mataPelajaran->nama_pelajaran }}</p>

                            <!-- Tombol Absen -->
                            @if ($jadwal->hari == \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd'))
                                <form action="{{ route('guru.absen') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if ($absensi->isNotEmpty() && !$absensi->last()->jam_keluar)
                                        <input type="file" name="foto_jam_keluar" accept="image/*" class="mb-4">
                                    @endif
                                    <button
                                        type="submit"
                                        class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
                                        Absen
                                    </button>
                                </form>
                            @else
                                <p class="text-sm text-gray-500">Absen Belum Dimulai.</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-600">Tidak ada jadwal mengajar.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-guruapp-layout>
