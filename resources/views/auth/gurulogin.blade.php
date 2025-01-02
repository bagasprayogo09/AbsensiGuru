<x-guruguest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md transform transition-all duration-500 hover:scale-105">
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200 animate-fade-in">
                {{-- Header dengan Logo --}}
                <div class="bg-blue-500 text-white text-center py-6 px-4 transform transition-all duration-300 hover:bg-blue-600">
                    <h2 class="text-2xl font-bold tracking-wider">GURU LOGIN</h2>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status
                    class="mb-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('guru.login') }}" class="p-6 space-y-6">
                    @csrf

                    {{-- Email Input --}}
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-600" />
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </span>
                            <x-text-input
                                id="email"
                                class="block mt-1 w-full pl-10 py-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md shadow-sm transition duration-300"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                    </div>

                    {{-- Password Input --}}
                    <div class="space-y-2">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-600" />
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fillRule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clipRule="evenodd" />
                                </svg>
                            </span>
                            <x-text-input
                                id="password"
                                class="block mt-1 w-full pl-10 py-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md shadow-sm transition duration-300"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                name="remember"
                            >
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm text-blue-500 hover:text-blue-700 transition duration-300"
                            >
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-6">
                        <x-primary-button
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:scale-105 active:scale-95"
                        >
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="text-center mt-4 text-gray-600 text-sm">
                <p>&copy; {{ date('Y') }} SMA Gita Kirtti 2 Jakarta</p>
            </div>
        </div>
    </div>

    {{-- Tambahkan di resources/css/app.css untuk animasi --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
    </style>
</x-guruguest-layout>
