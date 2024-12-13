<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Guru') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Detail Guru</h2>

            <div class="flex items-center mb-4">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $id->photo) }}" alt="Foto {{ $id->name }}" class="h-24 w-24 rounded-full mr-4">
                @else
                    <img src="https://via.placeholder.com/100" alt="Foto Default" class="h-24 w-24 rounded-full mr-4">
                @endif
                <div>
                    <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                </div>
            </div>

            <h4 class="text-lg font-semibold mt-6">Informasi Guru</h4>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Label</th>
                        <th class="border px-4 py-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2 font-semibold">Nama</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-semibold">Email</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('admin.guru.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Kembali ke Daftar Guru</a>
            </div>
        </div>
    </div>
</x-app-layout>
