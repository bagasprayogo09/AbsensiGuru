<x-app-layout>
    <x-slot:title>
        Laporan Absensi
    </x-slot:title>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Laporan Absensi</h1>

        <form action="{{ route('admin.absensi.report') }}" method="GET" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                        Tanggal Mulai
                    </label>
                    <input type="date"
                           name="start_date"
                           id="start_date"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ request('start_date', date('Y-m-d')) }}">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">
                        Tanggal Selesai
                    </label>
                    <input type="date"
                           name="end_date"
                           id="end_date"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ request('end_date', date('Y-m-d')) }}">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="guru_id">
                        Guru
                    </label>
                    <select name="guru_id"
                            id="guru_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Semua Guru</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}"
                                    {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select name="status"
                            id="status"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Semua Status</option>
                        @foreach($status_options as $key => $label)
                            <option value="{{ $key }}"
                                    {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6 flex space-x-4">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Filter
                </button>
            </div>
        </form>
        <form action="{{ route('admin.absensi.generateReport') }}" method="POST" class="inline-block">
            @csrf
            <input type="hidden" name="start_date" value="{{ request('start_date', date('Y-m-d')) }}">
            <input type="hidden" name="end_date" value="{{ request('end_date', date('Y-m-d')) }}">
            <input type="hidden" name="guru_id" value="{{ request('guru_id') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Generate PDF
            </button>
        </form>

        {{-- Tabel Hasil Filter --}}

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').value = today;
            document.getElementById('end_date').value = today;
        });
    </script>
    @endpush
</x-app-layout>
