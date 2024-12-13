<x-guruapp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    {{-- <div class="container mx-auto px-4 py-6 bg-blue-50 rounded-lg shadow-lg">
        @php
            // Ucapan dinamis berdasarkan waktu
            $hour = now()->format('H');
            $greeting = $hour < 12 ? 'Selamat pagi' : ($hour < 18 ? 'Selamat siang' : 'Selamat malam');
            // Mendapatkan hari saat ini
            $today = now()->isoFormat('dddd'); // Menggunakan format hari
        @endphp

        <h1 class="text-2xl font-bold mb-4 text-center text-black-600">
            {{ $greeting }}, {{ Auth::user()->name }}. Semangat untuk menjalani hari ini, {{ $today }}!
        </h1> --}}

        <!-- Pesan sukses -->
        @if (session('message'))
            <div class="alert alert-success mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded relative">
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <!-- Tombol Absen -->
        <div class="flex justify-center mt-6">
            <form action="{{ route('guru.absen') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
                    Absen
                </button>
            </form>
        </div>

        <!-- Data Absensi sebagai Card -->
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Data Absensi Anda</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($absensi as $item)
                    <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                        <p class="text-sm text-gray-600">Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</p>
                        <p class="text-sm text-gray-600">Jam Masuk: {{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</p>
                        <p class="text-sm text-gray-600">Jam Keluar: {{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '-' }}</p>
                        <p class="text-sm font-bold text-gray-700">Status: {{ ucfirst($item->status) }}</p>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-600">Tidak ada data absensi.</p>
                @endforelse
            </div>
        </div>

        <!-- Jadwal Mengajar sebagai Card -->
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Jadwal Mengajar Anda</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($jadwals as $jadwal)
                    <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                        <p class="text-sm text-gray-600">Hari: {{ ucfirst($jadwal->hari) }}</p>
                        <p class="text-sm font-bold text-gray-700">Mata Pelajaran: {{ $jadwal->mataPelajaran->nama_pelajaran}}</p>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-600">Tidak ada jadwal mengajar.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-guruapp-layout>
