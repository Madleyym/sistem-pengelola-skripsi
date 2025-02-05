<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-8 m-4">
                <!-- Logo and Title -->
                <div class="text-center mb-8">
                    <img src="/images/logo.png" alt="SIPENSI Logo" class="mx-auto h-12 w-auto mb-4">
                    <h2 class="text-3xl font-bold mb-2" style="background: linear-gradient(to right, #4f46e5, #818cf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Buat Akun Baru
                    </h2>
                    <p class="text-gray-600">Daftar akun SIPENSI Anda</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" class="text-gray-700 text-sm font-semibold mb-2" />
                        <x-text-input id="name"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm font-semibold mb-2" />
                        <x-text-input id="email"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
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
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 text-sm font-semibold mb-2" />
                        <x-text-input id="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex flex-col space-y-4">
                        <button type="submit"
                            class="w-full py-3 px-6 text-white font-semibold rounded-xl transition duration-150 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5">
                            {{ __('Register') }}
                        </button>

                        <a href="{{ route('login') }}"
                            class="text-center text-sm text-gray-600 hover:text-indigo-600 transition duration-150">
                            {{ __('Already have an account? Login') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>