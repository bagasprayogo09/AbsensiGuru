<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center justify-center">
    <div class="text-center">
        <img src="https://www.smagiki2jakarta.sch.id/upload/imagecache/22577728LogoGiki-600x536.png" alt="Logo" class="mb-6 logo-custom mx-auto logo-animated">
        <h1 class="text-2xl md:text-3xl text-black fade-text">Selamat Datang di Website Absensi Guru SMA Gita Kirtti 2 Jakarta</h1>
        <div class="flex flex-col items-center gap-2 py-10">
            @if (Route::has('login'))
                <nav class="flex flex-col items-center space-y-4">
                    <div class="flex justify-between w-full max-w-xs space-x-4">
                        @auth
                            @php
                                $role = Auth::user()->role;
                            @endphp
                            <a href="{{ $role === 'admin' ? route('dashboard') : ($role === 'guru' ? route('guru.dashboard') : url('/dashboard')) }}" class="btn btn-primary">
                                {{ $role === 'admin' ? 'Dashboard Admin' : ($role === 'guru' ? 'Dashboard Guru' : 'Dashboard User') }}
                            </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary px-10 py-3">
                            LOGIN
                        </a>
                        @endauth
                    </div>
                </nav>
            @endif
        </div>
    </div>
</body>
</html>
