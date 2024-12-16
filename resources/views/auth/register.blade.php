<x-guest-layout>
    <div class="h-screen flex bg-gradient-to-r from-amber-800 to-amber-900">
        <!-- Left Section: Image with Title -->
        <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('/images/biblio.jpg');">
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <h1 class="text-4xl font-bold text-white">Register to Unlock Book Reviews and Recommendations</h1>
            </div>
        </div>

        <!-- Right Section: Form -->
        <div class="w-1/2 flex items-center justify-center bg-gray-100">
            <div class="relative z-10 bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <x-authentication-card>
                    {{-- Validation Errors --}}
                    <x-validation-errors class="mb-4" />

                    {{-- Display custom error message --}}
                    @if(session('error'))
                        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        {{-- Email --}}
                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        </div>

                        {{-- Age --}}
                        <div class="mt-4">
                            <x-label for="age" value="{{ __('Age') }}" />
                            <x-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required autocomplete="age" />
                        </div>

                        {{-- Gender --}}
                        <div class="mt-4">
                            <x-label for="gender" value="{{ __('Gender') }}" />
                            <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                <option value="" disabled selected>{{ __('Select your gender') }}</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                            </select>
                        </div>

                        {{-- Password --}}
                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mt-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        {{-- Submit and Login Link --}}
                        <div class="flex items-center justify-between mt-4">
                            <a class="text-sm text-amber-900  underline hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 ml-4 bg-amber-900">
                               Register
                           </button>
                        </div>
                    </form>
                </x-authentication-card>
            </div>
        </div>
    </div>
</x-guest-layout>
