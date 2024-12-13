<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-6 sm:p-10 bg-white shadow-lg rounded-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Update Profile Information') }}</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-white shadow-lg rounded-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Change Password') }}</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-white shadow-lg rounded-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Delete Account') }}</h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
