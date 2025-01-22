<x-guruapp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-black leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <!-- Pesan sukses -->
    @if (session('message'))
        <div class="alert alert-success mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded relative">
            <span>{{ session('message') }}</span>
        </div>
    @endif

       <!-- Pesan error -->
       @if (session('error'))
       <div class="alert alert-danger mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded relative">
           <span>{{ session('error') }}</span>
       </div>
   @endif


    <!-- Grid untuk Data Absensi dan Jadwal Mengajar -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <!-- Jadwal Mengajar -->
        <div>
            <h2 class="text-xl font-bold mb-4 text-black">Jadwal Mengajar Anda</h2>
            <div class="grid grid-cols-1 gap-4">
                @forelse($jadwals as $jadwal)
                    <div class="card bg-white shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-black">Hari: {{ ucfirst($jadwal->hari) }}</h3>
                            <p class="text-sm font-bold text-black">Mata Pelajaran: {{ $jadwal->mataPelajaran->nama }}</p>
                            <p class="text-sm font-bold text-black">Jam: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                            <p class="text-sm font-bold text-black">Kelas: {{ $jadwal->kelas }}</p>

                            <!-- Tombol Absen -->
                            @if ($jadwal->hari == \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd'))
                                <form action="{{ route('guru.absen') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

                                    @php
                                        // Cari absensi untuk jadwal dan hari ini
                                        $absenHariIni = $absensi->where('jadwal_id', $jadwal->id)
                                            ->where('tanggal', \Carbon\Carbon::now('Asia/Jakarta')->toDateString())
                                            ->first();
                                    @endphp

                                    @if (!$absenHariIni)
                                        <button
                                            type="submit"
                                            class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
                                            Absen Masuk
                                        </button>
                                    @elseif (!$absenHariIni->jam_keluar)
                                        <input type="file" name="foto_jam_keluar"  class="mb-4">
                                        <h1>ukuran file maksimal 2 MB</h1>
                                        <button
                                            type="submit"
                                            class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
                                            Absen Keluar
                                        </button>
                                    @else
                                        <p class="text-sm text-gray-500">Absensi selesai untuk jadwal.</p>
                                    @endif
                                </form>
                            @else
                                <p class="text-sm text-gray-500">Absen hanya tersedia pada hari {{ $jadwal->hari }}.</p>
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
