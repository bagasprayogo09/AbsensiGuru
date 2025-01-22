<x-guruapp-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">Riwayat Kehadiran</h2>

                {{-- Informasi Guru --}}
                <div class="flex items-center mb-6">
                    <div class="avatar mr-4">
                        <div class="w-16 rounded-full">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">{{ auth()->guard('guru')->user()->name }}</h3>
                        <p class="text-sm text-gray-500">{{ auth()->guard('guru')->user()->email }}</p>
                    </div>
                </div>

                {{-- Statistik Ringkasan --}}
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="stat bg-base-200 rounded-lg p-4">
                        <div class="stat-title">Total Hadir</div>
                        <div class="stat-value">
                            {{ $absensis->where('status', 'hadir')->count() }}
                        </div>
                    </div>
                    <div class="stat bg-base-200 rounded-lg p-4">
                        <div class="stat-title">Total Izin</div>
                        <div class="stat-value">
                            {{ $absensis->where('status', 'izin')->count() }}
                        </div>
                    </div>
                    <div class="stat bg-base-200 rounded-lg p-4">
                        <div class="stat-title">Total Sakit</div>
                        <div class="stat-value">
                            {{ $absensis->where('status', 'sakit')->count() }}
                        </div>
                    </div>
                </div>

                {{-- Tabel Riwayat Absensi --}}
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                                <th>Bukti Absen Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $index => $absensi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        @if($absensi->jam_masuk)
                                            {{ \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') }}
                                        @else
                                            <span class="badge badge-warning">Belum Absen</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($absensi->jam_keluar)
                                            {{ \Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i') }}
                                        @else
                                            <span class="badge badge-warning">Belum Absen</span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($absensi->status)
                                            @case('hadir')
                                                <span class="badge badge-success">Hadir</span>
                                                @break
                                            @case('izin')
                                                <span class="badge badge-warning">Izin</span>
                                                @break
                                            @case('sakit')
                                                <span class="badge badge-info">Sakit</span>
                                                @break
                                            @default
                                                <span class="badge badge-neutral">Tidak Diketahui</span>
                                        @endswitch
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        @if($absensi->foto_keluar)
                                            <div class="avatar">
                                                <div class="w-12 rounded">
                                                    <img src="{{ asset('storage/' . $absensi->foto_keluar) }}"
                                                         alt="Foto Absen Keluar"
                                                         onclick="openImageModal(this.src)"
                                                    />
                                                </div>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="alert alert-info">
                                            Tidak ada riwayat absensi
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk zoom gambar --}}
    <dialog id="image_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <img id="modal_image" src="" alt="Zoom Gambar" class="w-full">
        </div>
    </dialog>

    @push('scripts')
    <script>
        function openImageModal(src) {
            const modal = document.getElementById('image_modal');
            const modalImage = document.getElementById('modal_image');
            modalImage.src = src;
            modal.showModal();
        }
    </script>
    @endpush
</x-guruapp-layout>
