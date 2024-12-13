<!-- resources/views/admin/matapelajaran/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="container mt-4" style="background-color: #f1f5f9; padding: 20px; border-radius: 8px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <a href="{{ route('admin.matapelajaran.create') }}" class="btn btn-primary mb-4">Tambah Mata Pelajaran</a>
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <thead class="bg-blue-200 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800">ID</th>
                            <th class="px-4 py-2 text-left text-gray-800">Nama Pelajaran</th>
                            <th class="px-4 py-2 text-center text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mataPelajarans as $index => $mataPelajaran)
                            <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200">
                                <td class="align-middle text-center px-4 py-2">{{ $mataPelajaran->id }}</td>
                                <td class="align-middle px-4 py-2">{{ $mataPelajaran->nama_pelajaran }}</td>
                                <td class="text-center align-middle px-4 py-2">
                                    <a href="{{ route('admin.matapelajaran.edit', $mataPelajaran) }}" class="btn btn-warning btn-sm" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='yellow'; this.style.borderColor='yellow';" onmouseout="this.style.background='white'; this.style.borderColor='black'" title="Edit Mata Pelajaran">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.matapelajaran.destroy', $mataPelajaran) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='red'; this.style.borderColor='red';" onmouseout="this.style.background='white'; this.style.borderColor='black'" title="Hapus Mata Pelajaran">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted" style="padding: 20px; font-size: 1.1rem;">
                                    Tidak ada mata pelajaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
