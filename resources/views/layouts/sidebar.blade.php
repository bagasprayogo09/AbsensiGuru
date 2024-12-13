<div class="sidebar w-64 bg-base-200 p-4 shadow-lg rounded-lg">
    <div class="flex items-center mb-6">
        <img src="https://www.smagiki2jakarta.sch.id/upload/imagecache/22577728LogoGiki-600x536.png" alt="Logo" class="h-12 w-12 mr-3 rounded-full shadow-md">
        <span class="text-lg font-semibold text-gray-800">SMA Gita Kirti 2</span>
    </div>
    <ul class="menu text-base-content">
        <li class="mb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-house mr-2">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                </svg>
                Dashboard
            </a>
        </li>
        <li class="mb-4 dropdown dropdown-hover">
            <div tabindex="0" role="button" class="flex items-center p-2 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-rolodex mr-2">
                    <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z"/>
                </svg>
                Daftar Guru
                <svg class="ml-auto h-3 w-3 transform transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor"><path d="M 5.5 7l4.5 4.5L14.5 7H5.5z" /></svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-48 p-2 shadow-lg">
                <li><a href="{{ route('admin.guru.create') }}" class="p-2 hover:bg-blue-100 transition duration-200">Tambah Guru</a></li>
                <li><a href="{{ route('admin.guru.index') }}" class="p-2 hover:bg-blue-100 transition duration-200">Daftar Semua Guru</a></li>
                <li><a href="{{ route('admin.matapelajaran.index') }}" class="p-2 hover:bg-blue-100 transition duration-200">Mata Pelajaran Guru</a></li>
                <li><a href="{{ route('admin.jadwal.index') }}" class="p-2 hover:bg-blue-100 transition duration-200">Jadwal Guru</a></li>
            </ul>
        </li>
        <li class="mb-4 dropdown dropdown-hover">
            <div tabindex="0" role="button" class="flex items-center p-2 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal mr-2">
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                </svg>
                Absensi
                <svg class="ml-auto h-3 w-3 transform transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor"><path d="M5.5 7l4.5 4.5L14.5 7H5.5z" /></svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-48 p-2 shadow-lg">
                <li><a href="{{ route('admin.absensi.index') }}" class="p-2 hover:bg-blue-100 transition duration-200">Daftar Absensi</a></li>
                <li><a href="{{ route('admin.absensi.laporan') }}" class="p-2 hover:bg-blue-100 transition duration-200">Laporan Absensi</a></li>
            </ul>
        </li>
        <li class="mb-4 dropdown dropdown-hover">
            <div tabindex="0" role="button" class="flex items-center p-2 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 ```blade
                    7 0 0 0 8 1"/>
                </svg>
                Data Admin
                <svg class="ml-auto h-3 w-3 transform transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor"><path d="M5.5 7l4.5 4.5L14.5 7H5.5z" /></svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-48 p-2 shadow-lg">
                <li><a href="{{ route('admin.index') }}" class="p-2 hover:bg-blue-100 transition duration-200">Daftar Admin</a></li>
                <li><a href="{{ route('admin.create') }}" class="p-2 hover:bg-blue-100 transition duration-200">Tambah Admin</a></li>
            </ul>
        </li>
        <li class="mb-4">
            <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
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

