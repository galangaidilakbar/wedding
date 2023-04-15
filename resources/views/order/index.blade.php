<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($orders as $order)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div
                        class="grid grid-cols-1 mt-6 first:mt-0 border dark:border-gray-700 rounded-lg shadow-sm px-6 py-4 space-y-6">

                        <!-- Nomor pesanan & Tombol -->
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ __('NO. PESANAN: ') }} {{ $order->id }}
                            </h2>
                            <x-primary-link href="{{ route('order.show', $order) }}">
                                {{ __('Lihat Detail Pesanan') }}
                            </x-primary-link>
                        </div>

                        <!-- Tanggal & Status -->
                        <div class="flex space-x-4">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('translations.Order date') }}: <span
                                    class="text-gray-900 dark:text-gray-100">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="border-l dark:border-gray-700"></div>
                            <div
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                {{ $order->status }}
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="grid grid-cols-1">
                            @foreach ($order->detail_orders as $cart)
                                <div class="flex space-x-8 mt-4 first:mt-0">
                                    <div class="w-32">
                                        <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}"
                                            class="rounded" loading="lazy">
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ $cart->product->name }}
                                        </div>
                                    </div>
                                    <div class="text-gray-600 dark:text-gray-400">
                                        Rp @rupiah($cart->product->price)
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-b border-dashed dark:border-gray-700"></div>

                        <!-- Total -->
                        <div class="text-right text-gray-900 dark:text-gray-100">
                            {{ __('Total Pesanan: ') }}
                            <span class="text-lg font-semibold">
                                Rp @rupiah($order->total_harga)
                            </span>
                        </div>
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
</x-app-layout>
