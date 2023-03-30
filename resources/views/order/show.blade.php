<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Order detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="mb-6 max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informasi Pesanan') }}
                            </h2>
                        </header>

                        <div class="mt-6 bg-gray-50 px-6 py-4 border border-dashed rounded-lg">
                            <div class="grid grid-cols-2 gap-4">
                                <div>{{ __('No. Pesanan') }}</div>
                                <div>{{ $order->id }}</div>

                                <div>{{ __('Tanggal Pesanan') }}</div>
                                <div>{{ $order->created_at->toDateTimeString() }}</div>

                                <div>{{ __('Tanggal Acara') }}</div>
                                <div>{{ $order->tanggal_acara }}</div>

                                <div>{{ __('Jenis Pembayaran') }}</div>
                                <div class="uppercase">{{ $order->jenis_pembayaran }}</div>

                                <div>{{ __('Metode Pembayaran') }}</div>
                                <div class="uppercase">{{ $order->metode_pembayaran }}</div>

                                <div>{{ __('Status Pesanan') }}</div>
                                <div class="uppercase">{{ $order->status }}</div>

                                <div>{{ __('Total Pesanan') }}</div>
                                <div>Rp @rupiah($order->total_harga)</div>
                            </div>
                        </div>
                    </section>

                    {{-- Alamat --}}
                    <section class="mb-6 max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Alamat Acara') }}
                            </h2>
                        </header>

                        <div class="mt-6 bg-gray-50 px-6 py-4 border border-dashed rounded-lg">
                            <div class="flex space-x-2">
                                <strong>{{ $order->address->full_name }}</strong>
                                <div class="border-l"></div>
                                <span>{{ $order->address->phone_number }}</span>
                            </div>
                            <div class="whitespace-pre-line">
                                {{ $order->address->detail }} ({{ $order->address->patokan }})
                            </div>
                        </div>
                    </section>

                    {{-- Produk Dipesan --}}
                    <section class="mb-6 max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Produk Dipesan') }}
                            </h2>
                        </header>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Image</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Produk
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Harga
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->detail_orders as $cart)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-32 p-4">
                                                <img src="{{ $cart->product->photo_url }}"
                                                    alt="{{ $cart->product->name }}">
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $cart->product->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp @rupiah($cart->product->price)
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr
                                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4" colspan="2">
                                            {{ __('Total Pesanan') }}
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                            Rp @rupiah($order->total_harga)
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
