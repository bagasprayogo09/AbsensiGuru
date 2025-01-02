<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="min-h-screen" style="background-image: url('https://www.smagiki2jakarta.sch.id/upload/picture/909223252.jpg'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold text-black mb-6 text-center animate-fade-in">Welcome Dashboard Admin</h1>
            <p class="text-lg text-black mb-8 text-center animate-fade-in">SMA Gita Kirti 2 Jakarta</p>
        </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-4 animate-slide-in-left">Daftar Jumlah Guru dan Grafik Kehadiran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tabel Guru -->
                        <div class="flex flex-col animate-fade-in">
                            <h3 class="text-lg font-semibold mb-2">Daftar Guru</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white dark:bg-gray-800 mb-6">
                                    <thead>
                                        <tr class="w-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                            <th class="py-3 px-4 text-left">Nama Guru</th>
                                            <th class="py-3 px-4 text-left">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($guru as $guru)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 animate-fade-in">
                                            <td class="py-2 px-4">{{ $guru->name }}</td>
                                            <td class="py-2 px-4">{{ $guru->email }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Grafik Kehadiran -->
                        <div class="flex flex-col animate-slide-in-right">
                            <h3 class="text-lg font-semibold mb-2">Grafik Kehadiran</h3>
                            <canvas id="absensiChart" width="500" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('absensiChart').getContext('2d');
        const absensiData = @json($absensiData); // Data absensi dari controller

        const labels = Object.keys(absensiData); // Tanggal absensi
        const hadir = Object.values(absensiData).map(data => data.hadir); // Jumlah hadir
        const tidakHadir = Object.values(absensiData).map(data => data.tidak_hadir); // Jumlah tidak hadir
        const izin = Object.values(absensiData).map(data => data.izin); // Jumlah izin

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Hadir',
                        data: hadir,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tidak Hadir',
                        data: tidakHadir,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Izin',
                        data: izin,
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
