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

        <!-- Tabel Daftar Jumlah Guru dan Grafik Kehadiran -->
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
                                            @foreach($user as $user)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 animate-fade-in">
                                                <td class="py-2 px-4">{{ $user->name }}</td>
                                                <td class="py-2 px-4">{{ $user->email }}</td>
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

        <!-- Integrasi Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Memproses data dari server-side (PHP) ke client-side (JavaScript)
            var absensiData = @json($absensiData);

            // Membuat array untuk labels (tanggal) dan datasets (jumlah kehadiran tiap status)
            var labels = Object.keys(absensiData);
            var hadirData = [];
            var tidakHadirData = [];
            var izinData = [];

            // Memasukkan jumlah status ke array masing-masing
            labels.forEach(function(tanggal) {
                hadirData.push(absensiData[tanggal].hadir || 0); // Pastikan ada nilai default
                tidakHadirData.push(absensiData[tanggal].tidak_hadir || 0);
                izinData.push(absensiData[tanggal].izin || 0);
            });

            // Membuat chart
            var ctx = document.getElementById('absensiChart').getContext('2d');
            var absensiChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Label dengan tanggal
                    datasets: [
                        {
                            label: 'Hadir',
                            data: hadirData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Tidak Hadir',
                            data: tidakHadirData,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Izin',
                            data: izinData,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>

        <!-- Integrasi SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>

        <!-- Animasi dengan Tailwind CSS -->
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            @keyframes slideInLeft {
                from {
                    transform: translateX(-100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .animate-fade-in {
                animation: fadeIn 1s ease-in-out;
            }

            .animate-slide-in-left {
                animation: slideInLeft 1s ease-in-out;
            }

            .animate-slide-in-right {
                animation: slideInRight 1s ease-in-out;
            }
        </style>
    </div>
</x-app-layout>
