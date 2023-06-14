<div
    class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 lg:hidden">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        {{-- Home --}}
        <x-bottom-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <x-slot name="bottom_nav_icon">
                <svg
                    class="w-6 h-6 mb-1"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
            </x-slot>
            <x-slot name="bottom_nav_text">Beranda</x-slot>
        </x-bottom-nav-link>

        {{-- Pesanan --}}
        <x-bottom-nav-link href="{{ route('order.index') }}" :active="request()->routeIs('order.*')">
            <x-slot name="bottom_nav_icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-6 h-6 mb-1">
                    <path fill-rule="evenodd"
                          d="M13 3v1.27a.75.75 0 001.5 0V3h2.25A2.25 2.25 0 0119 5.25v2.628a.75.75 0 01-.5.707 1.5 1.5 0 000 2.83c.3.106.5.39.5.707v2.628A2.25 2.25 0 0116.75 17H14.5v-1.27a.75.75 0 00-1.5 0V17H3.25A2.25 2.25 0 011 14.75v-2.628c0-.318.2-.601.5-.707a1.5 1.5 0 000-2.83.75.75 0 01-.5-.707V5.25A2.25 2.25 0 013.25 3H13zm1.5 4.396a.75.75 0 00-1.5 0v1.042a.75.75 0 001.5 0V7.396zm0 4.167a.75.75 0 00-1.5 0v1.041a.75.75 0 001.5 0v-1.041zM6 10.75a.75.75 0 01.75-.75h3.5a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75zm0 2.5a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot>
            <x-slot name="bottom_nav_text">Pesanan</x-slot>
        </x-bottom-nav-link>

        {{-- Keranjang --}}
        <x-bottom-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')">
            <x-slot name="bottom_nav_icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-6 h-6 mb-1">
                    <path
                        d="M1 1.75A.75.75 0 011.75 1h1.628a1.75 1.75 0 011.734 1.51L5.18 3a65.25 65.25 0 0113.36 1.412.75.75 0 01.58.875 48.645 48.645 0 01-1.618 6.2.75.75 0 01-.712.513H6a2.503 2.503 0 00-2.292 1.5H17.25a.75.75 0 010 1.5H2.76a.75.75 0 01-.748-.807 4.002 4.002 0 012.716-3.486L3.626 2.716a.25.25 0 00-.248-.216H1.75A.75.75 0 011 1.75zM6 17.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15.5 19a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
            </x-slot>
            <x-slot name="bottom_nav_text">Keranjang</x-slot>
        </x-bottom-nav-link>

        {{-- Profile --}}
        <x-bottom-nav-link href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')">
            <x-slot name="bottom_nav_icon">
                <svg
                    class="w-6 h-6 mb-1"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z">
                    </path>
                </svg>
            </x-slot>
            <x-slot name="bottom_nav_text">Profil</x-slot>
        </x-bottom-nav-link>
    </div>
</div>
