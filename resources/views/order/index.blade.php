<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @forelse($orders as $order)
                    <div class="grid grid-cols-1 mt-6 first:mt-0">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ __('NO. PESANAN: ') }} {{ $order->id }}
                            </h2>
                            <!-- Tombol -->
                            <div class="flex space-x-2">
                                <x-secondary-button-link href="{{ route('order.invoice', $order) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-1">
                                        <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm4.75 6.75a.75.75 0 011.5 0v2.546l.943-1.048a.75.75 0 011.114 1.004l-2.25 2.5a.75.75 0 01-1.114 0l-2.25-2.5a.75.75 0 111.114-1.004l.943 1.048V8.75z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('translations.Invoice') }}
                                </x-secondary-button-link>

                                <x-primary-button-link href="{{ route('order.show', $order) }}">
                                    {{ __('Lihat') }}
                                </x-primary-button-link>
                            </div>
                        </div>
                        <div class="flex space-x-4 border-b pb-2 mt-4">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('translations.Order date') }}: <span
                                    class="text-gray-900 dark:text-gray-100">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="border-l"></div>
                            <div>
                                {{ $order->status }}
                            </div>
                        </div>
                        <div class="grid grid-cols-1 mt-6 border-b pb-6">
                            @foreach($order->detail_orders as $cart)
                                <div class="flex space-x-8 mt-4 first:mt-0">
                                    <div class="w-32">
                                        <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}"
                                             class="rounded">
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ $cart->product->name }}
                                        </div>
                                    </div>
                                    <div>
                                        Rp @rupiah($cart->product->price)
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="mt-6 text-right text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Total Pesanan: ') }}
                            Rp @rupiah($order->total_harga)
                        </div>
                    </div>

                @empty
                    <div class="flex">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            {{ __('translations.No orders yet') }}
                        </h2>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
