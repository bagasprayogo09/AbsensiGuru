<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight">
            {{ __('Data Absensi') }}
        </h2>
    </x-slot>

    <div class="container mt-4 text-black" style="padding: 20px; border-radius: 8px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-black" role="alert" style="margin-top: 20px;">
                {{ session('success') }}
                <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary text-black">
                Tambah Absensi
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <thead class="bg-blue-200 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-black">No</th>
                            <th class="px-4 py-2 text-left text-black">Nama Guru</th>
                            <th class="px-4 py-2 text-left text-black">Tanggal</th>
                            <th class="px-4 py-2 text-left text-black">Jam Masuk</th>
                            <th class="px-4 py-2 text-left text-black">Jam Keluar</th>
                            <th class="px-4 py-2 text-left text-black">Foto Jam Keluar</th>
                            <th class="px-4 py-2 text-left text-black">Status</th>
                            <th class="px-4 py-2 text-left text-black">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensis as $index => $item)
                            <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200 text-black">
                                <td class="align-middle text-center px-4 py-2 text-black">{{ $index + 1 }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $item->guru ? $item->guru->name : 'Guru tidak ditemukan' }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') : '-' }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '-' }}</td>
                                <td class="align-middle px-4 py-2 text-center text-black">
                                    @if($item->foto_keluar)
                                    <img src="{{ asset('storage/' . $item->foto_keluar) }}"
                                    alt="Foto Absen Keluar"
                                    onclick="openImageModal(this.src)"
                                    style="max-width: 100px; max-height: 100px; cursor: pointer;"
                               />
                                @else
                                        Tidak ada foto
                                    @endif
                                </td>
                                <td class="align-middle px-4 py-2 text-black">{{ ucfirst($item->status) }}</td>
                                <td class="text-center align-middle px-4 py-2">
                                    <form action="{{ route('admin.absensi.destroy', $item) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1" style="background-color: white; border-color: #4a5568; font-weight: bold; color: black;" onmouseover="this.style.background='red'; this.style.borderColor='red';" onmouseout="this.style.background='white'; this.style.borderColor='black';" onclick="return confirm('Are you sure you want to delete this item?')" style="font-weight: bold;">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-black" style="padding: 20px; font-size: 1.1rem;">
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
