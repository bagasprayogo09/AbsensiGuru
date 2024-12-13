<x-guruapp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Histori Absensi') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6 bg-blue-50 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-center text-black-600">
            Histori Absensi Anda, {{ $user->name }}
        </h1>

        <!-- Tabel Data Absensi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead class="bg-blue-200 border-b">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800">Tanggal</th>
                        <th class="px-4 py-2 text-left text-gray-800">Jam Masuk</th>
                        <th class="px-4 py-2 text-left text-gray-800">Jam Keluar</th>
                        <th class="px-4 py-2 text-left text-gray-800">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensis as $absensi)
                        <tr class="hover:bg-blue-100 transition duration-200">
                            <td class="align-middle px-4 py-2">
                                {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}
                            </td>
                            <td class="align-middle px-4 py-2">
                                {{ $absensi->jam_masuk ? \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') : '-' }}
                            </td>
                            <td class="align-middle px-4 py-2">
                                {{ $absensi->jam_keluar ? \Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i') : '-' }}
                            </td>
                            <td class="align-middle px-4 py-2">
                                {{ ucfirst($absensi->status) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-600 py-4">
                                Tidak ada histori absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-guruapp-layout>
