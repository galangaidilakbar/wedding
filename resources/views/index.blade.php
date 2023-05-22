<x-guest-layout>
    <div class="text-center">
        Selamat datang di {{ config('app.name') }}
    </div>

    <div class="flex justify-center items-center space-x-4 mt-6">
        <x-primary-button-link href="{{ route('login') }}">
            Login
        </x-primary-button-link>

        <x-secondary-button-link href="{{ route('register') }}">
            Register
        </x-secondary-button-link>
    </div>
</x-guest-layout>
