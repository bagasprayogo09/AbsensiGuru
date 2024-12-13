<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Absensi') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-4">
            <!-- Bagian Form -->
            <form method="GET" action="{{ route('admin.absensi.laporan') }}" class="flex flex-wrap items-center space-x-2">
                <div>
                    <h1>Periode awal</h1>
                    <input type="date" id="start_date" name="start_date" required class="input input-bordered">
                </div>
                <div>
                    <h1>Periode akhir</h1>
                    <input type="date" id="end_date" name="end_date" required class="input input-bordered">
                </div>
                <div>
                    <h1>Status</h1>
                    <select id="status" name="status" class="select select-bordered">
                        <option value="">Semua Status</option>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="tidak_hadir">Tidak Hadir</option>
                    </select>
                </div>
                <div>
                    <h1>Nama Guru</h1>
                    <input type="text" id="nama" name="nama" placeholder="Cari Nama" class="input input-bordered">
                </div>
                <div>
                    <h1>User ID</h1>
                    <input type="text" id="user_id" name="user_id" placeholder="Cari User ID" class="input input-bordered">
                </div>
                <button type="submit" class="btn btn-primary gap-3">Filter</button>
            </form>
            <!-- Bagian Tombol -->
            <div class="flex ml-auto space-x-2">
                <a href="{{ route('admin.absensi.exportPDF', request()->query()) }}" class="btn btn-secondary gap-3">Export PDF</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead class="bg-blue-200 border-b">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800">No</th>
                        <th class="px-4 py-2 text-left text-gray-800">Nama Guru</th>
                        <th class="px-4 py-2 text-left text-gray-800">Tanggal</th>
                        <th class="px-4 py-2 text-left text-gray-800">Jam Masuk</th>
                        <th class="px-4 py-2 text-left text-gray-800">Jam Keluar</th>
                        <th class="px-4 py-2 text-left text-gray-800">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensis as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200">
                            <td class="py-2 px-4 border-b text-center">{{ $item->user_id }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->jam_masuk }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->jam_keluar }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($item->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-2 px-4 text-center text-muted" style="padding: 20px; font-size: 1.1rem;">
                                Tidak ada data absensi untuk ditampilkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
