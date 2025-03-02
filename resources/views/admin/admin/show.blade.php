<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-black">
            {{ __('Detail Admin') }}
        </h2>
    </x-slot>
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg shadow-md w-full">
                    <thead class="bg-blue-600 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-black">Nama</th>
                            <th class="px-4 py-2 text-left text-black">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user  as $user)
                            <td class="align-middle px-4 py-2 text-black">{{ $user->name }}</td>
                            <td class="align-middle px-4 py-2 text-black">{{ $user->email }}</td>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="alert alert-info">
                                        <div class="flex-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <label>Tidak ada data admin</label>
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
    <!-- Tombol Kembali -->
    <div class="mt-6">
        <a href="{{ route('admin.index') }}" class="btn btn-primary">
            Kembali ke Daftar Admin
        </a>
    </div>
</div>
</x-app-layout>
