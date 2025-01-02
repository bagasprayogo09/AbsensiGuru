<x-app-layout>
    <!-- Slot untuk header -->
    <x-slot name="header">
        <!-- Judul header -->
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight">
            {{ __('Data Absensi') }}
        </h2>
    </x-slot>

    <!-- Container untuk isi konten -->
    <div class="container mt-4 text-black" style="padding: 20px; border-radius: 8px;">
        <!-- Cek jika ada session success -->
        @if(session('success'))
            <!-- Tampilkan alert success -->
            <div class="alert alert-success alert-dismissible fade show text-black" role="alert" style="margin-top: 20px;">
                {{ session('success') }}
                <!-- Tombol untuk menutup alert -->
                <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol untuk menambah absensi -->
        <div class="mb-4">
            <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary text-black">
                Tambah Absensi
            </a>
        </div>

        <!-- Isi konten -->
        <div class="card-body">
            <!-- Tabel untuk menampilkan data -->
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <!-- Header tabel -->
                    <thead class="bg-blue-200 border-b">
                        <tr>
                            <!-- Kolom no -->
                            <th class="px-4 py-2 text-left text-black">No</th>
                            <!-- Kolom nama guru -->
                            <th class="px-4 py-2 text-left text-black">Nama Guru</th>
                            <!-- Kolom tanggal -->
                            <th class="px-4 py-2 text-left text-black">Tanggal</th>
                            <!-- Kolom status -->
                            <th class="px-4 py-2 text-left text-black">Status</th>
                        </tr>
                    </thead>
                    <!-- Isi tabel -->
                    <tbody>
                        <!-- Looping data absensi -->
                        @forelse($absensis as $index => $item)
                            <!-- Baris tabel -->
                            <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200 text-black">
                                <td class="align-middle text-center px-4 py-2 text-black">{{ $index + 1 }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $item->guru ? $item->guru->name : 'Guru tidak ditemukan' }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ ucfirst($item->status) }}</td>
                            </tr>
                        @empty
                            <!-- Tampilkan pesan jika tidak ada data -->
                            <tr>
                                <td colspan="5" class="text-center text-black" style="padding: 20px; font-size: 1.1rem;">
                                    Tidak ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
