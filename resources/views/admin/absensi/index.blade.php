<x-app-layout>
    <!-- Slot untuk header -->
    <x-slot name="header">
        <!-- Judul header -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Absensi') }}
        </h2>
    </x-slot>

    <!-- Container untuk isi konten -->
    <div class="container mt-4" style="background-color: #f1f5f9; padding: 20px; border-radius: 8px;">
        <!-- Cek jika ada session success -->
        @if(session('success'))
            <!-- Tampilkan alert success -->
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                {{ session('success') }}
                <!-- Tombol untuk menutup alert -->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Isi konten -->
        <div class="card-body">
            <!-- Tabel untuk menampilkan data -->
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <!-- Header tabel -->
                    <thead class="bg-blue-200 border-b">
                        <tr>
                            <!-- Kolom no -->
                            <th class="px-4 py-2 text-left text-gray-800">No</th>
                            <!-- Kolom nama guru -->
                            <th class="px-4 py-2 text-left text-gray-800">Nama Guru</th>
                            <!-- Kolom tanggal -->
                            <th class="px-4 py-2 text-left text-gray-800">Tanggal</th>
                            <!-- Kolom jam masuk -->
                            <th class="px-4 py-2 text-left text-gray-800">Jam Masuk</th>
                            <!-- Kolom jam keluar -->
                            <th class="px-4 py-2 text-left text-gray-800">Jam Keluar</th>
                            <!-- Kolom status -->
                            <th class="px-4 py-2 text-left text-gray-800">Status</th>
                            <!-- Kolom aksi -->
                            <th class="px-4 py-2 text-center text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <!-- Isi tabel -->
                    <tbody>
                        <!-- Looping data absensi -->
                        @forelse($absensis as $index => $item)
                            <!-- Baris tabel -->
                            <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200">
                                <!-- Kolom no -->
                                <td class="align-middle text-center px-4 py-2">{{ $index + 1 }}</td>
                                <!-- Kolom nama guru -->
                                <td>{{ $item->user->name }}</td>
                                <!-- Kolom tanggal -->
                                <td class="align-middle px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <!-- Kolom jam masuk -->
                                <td class="align-middle px-4 py-2">{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</td>
                                <!-- Kolom jam keluar -->
                                <td class="align-middle px-4 py-2">{{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '-' }}</td>
                                <td class="align-middle px-4 py-2 text-center">
                                    <span
                                        class="badge
                                            {{ strtolower($item->status) === 'hadir' ? 'badge-green' : '' }}
                                            {{ strtolower($item->status) === 'izin' ? 'badge-yellow' : '' }}
                                            {{ strtolower($item->status) === 'tidak hadir' ? 'badge-red' : '' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                <!-- Kolom aksi -->
                                <td class="text-center align-middle px-4 py-2">
                                    <!-- Link untuk edit absensi -->
                                    <a href="{{ route('admin.absensi.edit', $item->id) }}" class="btn btn-warning btn-sm" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='yellow'; this.style.borderColor='yellow';" onmouseout="this.style.background='white'; this.style.borderColor='black'" title="Edit Absensi">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <!-- Link untuk hapus absensi -->
                                    {{-- <a href="{{ route('admin.absensi.delete', $item->id) }}" class="btn btn -danger btn-sm" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='red'; this.style.borderColor='red';" onmouseout="this.style.background='white'; this.style.borderColor='black'" title="Hapus Absensi">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a> --}}
                                </td>
                            </tr>
                        @empty
                            <!-- Tampilkan pesan jika tidak ada data -->
                            <tr>
                                <td colspan="7" class="text-center text-muted" style="padding: 20px; font-size: 1.1rem;">
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
