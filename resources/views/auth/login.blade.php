<x-guest-layout>
<script src="https://cdn.tailwindcss.com"></script>
    <!-- Background Section -->
    <div class="h-screen flex bg-white">
        <!-- Left Section: Image with Title -->
        <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('/images/biblio.jpg');">
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <h1 class="text-4xl font-bold text-white">Sign In to Track Your Reading Journey</h1>
            </div>
        </div>

        <div class="w-1/2 flex items-center justify-center bg-white">
        <div class="relative z-10 bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <x-authentication-card >
        {{-- Validation Errors --}}
        <x-validation-errors class="mb-4" />

             {{-- Display custom error message --}}
                    @if(session('error'))
                        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold"/>
                    <x-input id="email" class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500" 
                             type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <!-- Password Field -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold"/>
                    <x-input id="password" class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500" 
                             type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center text-gray-600">
                        <x-checkbox id="remember_me" name="remember" class="text-amber-500"/>
                        <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password and Login Button -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ms-4 bg text-amber py-2 px-4 rounded-md shadow-lg hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
