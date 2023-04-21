<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    <!-- Search bar -->
                    <div>
                        <x-search-bar to="{{ route('order.index') }}" placeholder="Cari pesananmu di sini"/>
                    </div>

                    <!-- Filter by status-->

                    <!-- Filter by date -->
                </div>
            </div>

            @forelse($orders as $order)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 mt-6 first:mt-0 space-y-6">
                        <!-- Header -->
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4 justify-between items-center lg:justify-start w-full lg:w-auto">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $order->created_at->format('d M Y') }}
                                </div>

                                <x-badge-status :text="$order->status" :color="$order->status_color" />

                                <div class="text-sm text-gray-500 dark:text-gray-400 hidden lg:block select-all">
                                    {{ $order->id }}
                                </div>
                            </div>
                            <x-primary-link href="{{ route('order.show', $order) }}" class="hidden lg:block text-sm">
                                {{ __('Lihat Detail Pesanan') }}
                            </x-primary-link>
                        </div>

                        <div class="border-b border-dashed dark:border-gray-700"></div>

                        <!-- Products -->
                        <div class="grid grid-cols-1">
                            @foreach ($order->detail_orders as $cart)
                                <div class="flex space-x-8 mt-4 first:mt-0">
                                    <div class="w-32">
                                        <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}"
                                             class="rounded" loading="lazy">
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm lg:text-base font-medium text-gray-900 dark:text-gray-100">
                                            {{ $cart->product->name }}
                                        </div>
                                    </div>
                                    <div class="hidden lg:block text-gray-600 dark:text-gray-400">
                                        Rp @rupiah($cart->product->price)
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-b border-dashed dark:border-gray-700"></div>

                        <!-- Total transaction in dekstop-->
                        <div class="hidden lg:block text-right">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Total Pesanan: ') }}
                            </div>
                            <div class="font-bold text-gray-900 dark:text-gray-100">
                                Rp @rupiah($order->total_harga)
                            </div>
                        </div>

                        <!-- Total transaction in mobile-->
                        <div class="flex justify-between items-center lg:hidden">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Total Pesanan: ') }}
                                <div class="text-sm font-semibold">
                                    Rp @rupiah($order->total_harga)
                                </div>
                            </div>
                            <x-primary-link href="{{ route('order.show', $order) }}" class="text-sm">
                                {{ __('Lihat Detail Pesanan') }}
                            </x-primary-link>
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

            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
