<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Admin') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-body">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead class="bg-blue-200 border-b">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800">No</th>
                        <th class="px-4 py-2 text-left text-gray-800">Nama</th>
                        <th class="px-4 py-2 text-left text-gray-800">Email</th>
                        <th class="px-4 py-2 text-left text-gray-800">Role</th>
                        <th class="px-4 py-2 text-center text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $index => $admin)
                        <tr class="{{ $index % 2 == 0 ? 'bg-blue-100' : 'bg-blue-200' }} hover:bg-blue-300 transition duration-200">
                            <td class="align-middle text-center px-4 py-2">{{ $index + 1 }}</td>
                            <td class="align-middle text-center px-4 py-2">{{ $admin->name }}</td>
                            <td class="align-middle text-center px-4 py-2">{{ $admin->email }}</td>
                            <td class="align-middle text-center px-4 py-2">{{ $admin->role }}</td>
                            <td class="text-center align-middle px-4 py-2">
                                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm mx-1" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='yellow'; this.style.borderColor='yellow';" onmouseout="this.style.background='white'; this.style.borderColor='black';">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-1" style="background-color: white; border-color: #4a5568; font-weight: bold; color: black;" onmouseover="this.style.background='red'; this.style.borderColor='red';" onmouseout="this.style.background='white'; this.style.borderColor='black';" onclick="return confirm('Are you sure you want to delete this item?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted" style="padding: 20px; font-size: 1.1rem;">
                                Tidak ada data admin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
