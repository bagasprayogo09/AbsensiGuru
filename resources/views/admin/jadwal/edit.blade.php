<!-- resources/views/admin/jadwal/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Jadwal') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="hari" class="block font-medium text-sm text-gray-700">{{ __('Hari') }}</label>
                            <input id="hari" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('hari') border-red-500 @enderror" name="hari" value="{{ old('hari', $jadwal->hari) }}" required autocomplete="hari" autofocus>

                            @error('hari')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="mata_pelajaran" class="block font-medium text-sm text-gray-700">{{ __('Mata Pelajaran') }}</label>
                            <input id="mata_pelajaran" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('mata_pelajaran') border-red-500 @enderror" name="mata_pelajaran" value="{{ old('mata_pelajaran', $jadwal->mata_pelajaran) }}" required autocomplete="mata_pelajaran" autofocus>

                            @error('mata_pelajaran')
                                <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
