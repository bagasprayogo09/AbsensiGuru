<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Guru') }}
        </h2>
    </x-slot>

    <div class="container mt-4" style="background-color: #f1f5f9; padding: 20px; border-radius: 8px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary" style="font-weight: bold; padding: 10px 20px;">
                <i class="fas fa-plus-circle"></i> Tambah Guru
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="min-w-full bg-white border rounded-lg shadow-md w-full"> <!-- Menambahkan kelas w-full -->
                    <thead class="bg-blue-200 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800">No</th>
                            <th class="px-4 py-2 text-left text-gray-800">Nama</th>
                            <th class="px-4 py-2 text-left text-gray-800">Email</th>
                            <th class="px-4 py-2 text-left text-gray-800">Mata Pelajaran</th> <!-- Kolom baru untuk mata pelajaran -->
                            <th class="px-4 py-2 text-center text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200">
                                <td class="align-middle text-center px-4 py-2">{{ $index + 1 }}</td>
                                <td class="align-middle px-4 py-2">{{ $user->name }}</td>
                                <td class="align-middle px-4 py-2">{{ $user->email }}</td>
                                <td class="align-middle px-4 py-2">
                                    @foreach($user->jadwal->pluck('mataPelajaran.nama_pelajaran')->unique() as $nama_pelajaran)
                                        {{ $nama_pelajaran }} @if(!$loop->last), @endif
                                    @endforeach
                                </td>

                                </td>
                                <td class="text-center align-middle px-4 py-2">
                                    <a href="{{ route('admin.guru.show', $user) }}" class="btn btn-info btn-sm mx-1" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='#0000FF'; this.style.borderColor='#0000FF';" onmouseout="this.style.background='white'; this.style.borderColor='black'">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.guru.edit', $user) }}" class="btn btn-warning btn-sm mx- 1" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='yellow'; this.style.borderColor='yellow';" onmouseout="this.style.background='white'; this.style.borderColor='black'">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $user) }}" method="POST" style="display:inline;">
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
                                <td colspan="6" class="text-center text-muted" style="padding: 20px; font-size: 1.1rem;">
                                    Tidak ada data guru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
