<div class="sidebar w-64 bg-base-200 p-4 shadow-lg rounded-lg">
    <div class="flex items-center mb-6">
        <img src="https://www.smagiki2jakarta.sch.id/upload/imagecache/22577728LogoGiki-600x536.png" alt="Logo" class="h-12 w-12 mr-3 rounded-full shadow-md">
        <span class="text-lg font-semibold text-gray-800">SMA Gita Kirti 2</span>
    </div>
    <ul class="menu text-base-content">
        <li class="mb-4">
            <a href="{{ route('guru.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-house mr-2">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                </svg>
                Dashboard
            </a>
            <li class="mb-4">
                <a href="{{ route('guru.absensi.history') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 mr-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.41 0-8 2.69-8 6v1h16v-1c0-3.31-3.59-6-8-6z"></path>
                    </svg>
                    Riwayat Kehadiran
                </a>
            </li>
        </li>
        <li class="mb-4">
            <a href="{{ route('guru.profile.edit') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.41 0-8 2.69-8 6v1h16v-1c0-3.31-3.59-6-8-6z"></path>
                </svg>
                Profile
            </a>
        </li>
        <li class="mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center p-3 rounded-lg hover:bg-red-600 hover:text-white transition duration-200 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 mr-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m8-8l-4 4m4-4l4 4m-4 4l4-4m-4 4l-4-4"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
