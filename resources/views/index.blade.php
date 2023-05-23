<x-guest-layout>
    <div class="text-center text-sm text-gray-500 dark:text-gray-400">
        Selamat datang di {{ config('app.name') }}
    </div>

    <div class="flex justify-center items-center space-x-4 mt-6">
        @auth
            <x-primary-button-link href="{{ route('dashboard') }}">
                Dashboard
            </x-primary-button-link>
            @else
            <x-primary-button-link href="{{ route('login') }}">
                Login
            </x-primary-button-link>

            <x-secondary-button-link href="{{ route('register') }}">
                Register
            </x-secondary-button-link>
        @endauth
    </div>
</x-guest-layout>
