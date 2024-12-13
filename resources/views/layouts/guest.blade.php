<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Styles -->
    <style>
        body {
            animation: fadeIn 1s ease-in-out; /* Animasi fade in untuk body */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .container {
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            transition: transform 0.2s;
            opacity: 0; /* Mulai tidak terlihat */
            animation: slideIn 0.5s forwards; /* Animasi slide in */
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .container:hover {
            transform: scale(1.02);
        }

        .button {
            background-color: #4facfe;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 16px;
        }

        .button:hover {
            background-color: #00f2fe;
            transform: translateY(-2px);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-blue-800 to-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <img src="https://www.smagiki2jakarta.sch.id/upload/imagecache/22577728LogoGiki-600x536.png" alt="Logo Giki" class="w-80 h-70" />
            </a>
        </div>

        <div class="w-full custom-width mt-6 px-6 py-4 container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
