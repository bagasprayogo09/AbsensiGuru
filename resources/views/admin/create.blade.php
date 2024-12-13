<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Admin') }}
        </h2>
    </x-slot>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="label">
                <span class="label-text">Nama:</span>
            </label>
            <input type="text" name="name" required class="input input-bordered w-full" value="{{ old('name') }}">
            @error('name')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email" class="label">
                <span class="label-text">Email:</span>
            </label>
            <input type="email" name="email" required class="input input-bordered w-full" value="{{ old('email') }}">
            @error('email')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password" class="label">
                <span class="label-text">Password:</span>
            </label>
            <input type="password" name="password" required class="input input-bordered w-full">
            @error('password')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-full">Tambah Admin</button>
    </form>
</x-app-layout>
