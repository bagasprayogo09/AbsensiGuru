<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Absensi Guru') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .logo-animate {
                animation: fadeIn 0.8s ease-out;
                transition: transform 0.3s ease;
            }

            .logo-animate:hover {
                transform: scale(1.1) rotate(5deg);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-100 to-blue-300">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="logo-animate mb-6">
                <a href="/" class="block">
                    <img
                        src="https://www.smagiki2jakarta.sch.id/upload/imagecache/22577728LogoGiki-600x536.png"
                        alt="SMA Gita Kirtti 2 Jakarta Logo"
                        class="w-40 h-40 object-contain rounded-full shadow-lg border-4 border-white"
                    />
                </a>
            </div>

            <div class="w-full max-w-2xl mt-6 px-8 py-10 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl border border-gray-200 transform transition-all duration-500 hover:scale-105">
                    <div class="flex flex-col justify-center">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} SMA Gita Kirtti 2 Jakarta
            </div>
        </div>
    </body>
</html>
