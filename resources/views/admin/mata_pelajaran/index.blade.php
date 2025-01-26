<!-- resources/views/admin/mata_pelajaran/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-black">
            {{ __('Daftar Mata Pelajaran') }}
        </h2>
    </x-slot>
    <div class="container mt-4" style="background-color: #f1f5f9; padding: 20px; border-radius: 8px;">
                <div class="card-body">
                    <a href="{{ route('admin.mata_pelajaran.create') }}" class="btn btn-primary mb-4">Tambah Mata Pelajaran</a>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="min-w-full bg-white border rounded-lg shadow-md">
                            <thead class="bg-blue-200 border-b">
                                <tr>
                                    <th class="px-4 py-2 text-left text-black">ID</th>
                                    <th class="px-4 py-2 text-left text-black">Nama Pelajaran</th>
                                    <th class="px-4 py-2 text-center text-black">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($mataPelajarans as $index => $mataPelajaran)
                                <tr>
                                    <td class="align-middle px-4 py-2 text-black" >{{ $index + 1 }}</td>
                                    <td class="align-middle px-4 py-2 text-black">{{ $mataPelajaran->nama }}</td>
                                    <td class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.mata_pelajaran.edit', $mataPelajaran) }}" class="btn btn-warning btn-sm" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='yellow'; this.style.borderColor='yellow';" onmouseout="this.style.background='white'; this.style.borderColor='black'" title="Edit Mata Pelajaran">
                                            <i class="fas fa-edit mr-2"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.mata_pelajaran.destroy', $mataPelajaran) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"class="btn btn-danger btn-sm" style="font-weight: bold; color: black; background-color: white; border-color: #4a5568;" onmouseover="this.style.background='red'; this.style.borderColor='red';" onmouseout="this.style.background='white'; this.style.borderColor='black'" title="Hapus Mata Pelajaran" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                <i class="fas fa-trash mr-2"></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

</x-app-layout>
