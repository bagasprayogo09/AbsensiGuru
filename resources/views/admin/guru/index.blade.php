<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-black">
            {{ __('Data Guru') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Guru
            </a>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert alert-success mb-4">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <label>{{ session('success') }}</label>
                </div>
            </div>
        @endif
        {{-- Table Container --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border rounded-lg shadow-md w-full"> <!-- Menambahkan kelas w-full -->
                        <thead class="bg-blue-600 border-b">
                            <tr>
                                <th class="px-4 py-2 text-left text-black">Nama</th>
                                <th class="px-4 py-2 text-left text-black">Email</th>
                                <th class="px-4 py-2 text-left text-black">Pendidikan Terakhir</th>
                                <th class="px-4 py-2 text-left text-black">Jurusan</th>
                                <th class="px-4 py-2 text-center text-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gurus as $guru)
                                <td class="align-middle px-4 py-2 text-black">{{ $guru->name }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $guru->email }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $guru->pendidikan_terakhir }}</td>
                                <td class="align-middle px-4 py-2 text-black">{{ $guru->jurusan }}</td>
                                <td class="text-center align-middle px-4 py-2">
                                    <a href="{{ route('admin.guru.edit', $guru) }}" class="btn btn-warning btn-sm mx- 1" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='yellow'; this.style.borderColor='yellow';" onmouseout="this.style.background='white'; this.style.borderColor='black'">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $guru) }}" method="POST" style="display:inline;">
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
                                    <td colspan="4" class="text-center py-4">
                                        <div class="alert alert-info">
                                            <div class="flex-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <label>Tidak ada data guru</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
