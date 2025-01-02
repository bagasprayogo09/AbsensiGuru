<!-- resources/views/admin/mata_pelajaran/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div ```blade
        class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.mata_pelajaran.update', $mataPelajaran) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nama" :value="__('Nama Mata Pelajaran')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" value="{{ $mataPelajaran->nama }}" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Perbarui') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
