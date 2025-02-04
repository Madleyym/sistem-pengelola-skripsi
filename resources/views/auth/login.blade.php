<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center" style="background: linear-gradient(135deg, #fff 0%, #f1f5f9 100%);">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-8 m-4">
                <!-- Logo and Title -->
                <div class="text-center mb-8">
                    <img src="/images/logo.png" alt="SIPENSI Logo" class="mx-auto h-12 w-auto mb-4">
                    <h2 class="text-3xl font-bold mb-2" style="background: linear-gradient(to right, #4f46e5, #818cf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Selamat Datang Kembali
                    </h2>
                    <p class="text-gray-600">Masuk ke akun SIPENSI Anda</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm font-semibold mb-2" />
                        <x-text-input id="email"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-sm font-semibold mb-2" />
                        <x-text-input id="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6 flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 transition duration-150"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex flex-col space-y-4">
                        <button type="submit"
                            class="w-full py-3 px-6 text-white font-semibold rounded-xl transition duration-150 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5">
                            {{ __('Log in') }}
                        </button>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-center text-sm text-gray-600 hover:text-indigo-600 transition duration-150">
                            {{ __('Don\'t have an account? Register') }}
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>