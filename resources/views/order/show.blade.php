<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Order detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Alert Menunggu Pembayaran -->
                    @if ($order->status === 'Menunggu Pembayaran')
                        <div class="p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                            role="alert">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Info</span>
                                <h3 class="text-lg font-medium">{{ $order->status }}</h3>
                            </div>

                            <div class="mt-2 mb-4 text-sm">
                                Saat ini, kami sedang menunggu pembayaran dari Anda. Mohon segera melakukan
                                pembayaran agar transaksi dapat segera diselesaikan. Terima kasih.
                            </div>

                            <a href="{{ route('order.payments.create', $order) }}"
                                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800">
                                {{ __('Lakukan Pembayaran') }}
                            </a>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 space-y-6">
                        <!-- Status -->
                        <div class="flex justify-between items-center">
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ $order->status }}
                            </h6>

                            <x-primary-link href="#">
                                Lihat Detail
                            </x-primary-link>
                        </div>

                        <div class="border-b dark:border-gray-400 border-dashed"></div>

                        <!-- Invoice -->
                        <div class="flex justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('translations.Invoice') }}
                            </div>
                            <div class="text-gray-900 text-sm">
                                <x-secondary-button-link href="{{ route('order.invoice', $order) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5 mr-1">
                                        <path fill-rule="evenodd"
                                            d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm4.75 6.75a.75.75 0 011.5 0v2.546l.943-1.048a.75.75 0 011.114 1.004l-2.25 2.5a.75.75 0 01-1.114 0l-2.25-2.5a.75.75 0 111.114-1.004l.943 1.048V8.75z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Unduh') }}
                                </x-secondary-button-link>
                            </div>
                        </div>

                        <!-- Tanggal Pesanan -->
                        <div class="flex justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('translations.Order date') }}
                            </div>
                            <div class="text-gray-900 dark:text-gray-100 text-sm">
                                {{ $order->created_at->format('d F Y, H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Detail Produk') }}
                            </h6>
                        </header>

                        <div class="grid grid-cols-1 mt-6">
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
                                    <div class="text-gray-700 dark:text-gray-400">
                                        Rp @rupiah($cart->product->price)
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-b dark:border-gray-400 border-dashed mt-6"></div>

                        <!-- Catatan -->
                        <div class="grid grid-cols-1 gap-4 mt-6">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('Catatan') }}
                            </div>
                            <div class="text-gray-900 dark:text-gray-100 text-sm">
                                {{ $order->catatan }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Alamat Acara -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Alamat Acara') }}
                            </h6>
                        </header>

                        <div class="mt-6">
                            <div class="font-bold mb-1 text-gray-900 dark:text-gray-100">
                                {{ $order->address->full_name }}</div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">{{ $order->address->phone_number }}
                            </div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ $order->address->detail }} ({{ $order->address->patokan }})
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Rincian Pembayaran -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Rincian Pembayaran') }}
                            </h6>
                        </header>

                        <div class="grid grid-cols-1 mt-6 space-y-3">
                            <!-- Opsi Bayar -->
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Opsi Bayar') }}
                                </div>
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $order->opsi_bayar }}
                                </div>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Metode Pembayaran') }}
                                </div>
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $order->metode_pembayaran }}
                                </div>
                            </div>

                            <!-- Total DP -->
                            @if ($order->opsi_bayar === 'DP')
                                <div class="flex justify-between">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('Total DP') }}
                                    </div>
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        Rp @rupiah($order->total_dp)
                                    </div>
                                </div>
                            @endif

                            <!-- Riwayat Pembayaran -->
                            <div class="grid grid-cols-2" x-data="{ open: false }">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Riwayat Pembayaran') }}
                                </div>
                                <button @click="open = !open"
                                    class="text-right font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    x-text="open ? '{{ __('Tutup') }}' : '{{ __('Lihat Detail') }}'">
                                </button>

                                <!-- Detail Riwayat Pembayaran -->
                                <div x-show="open" x-transition class="col-span-2 mt-6">
                                    @forelse ($order->payments as $payment)
                                        <div class="flex justify-between gap-4">
                                            <!-- Bukti Bayar -->
                                            <div class="w-32">
                                                <img src="{{ $payment->proof_of_payment_url }}"
                                                    alt="{{ $payment->proof_of_payment }}">
                                            </div>

                                            <div class="grow">
                                                <!-- Status Pembayaran -->
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $payment->status }}
                                                </div>

                                                <!-- Catatan dari admin -->
                                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ $payment->note }}
                                                </div>

                                                <!-- Last Update -->
                                                <div class="text-xs italic text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ __('Pembaharuan terakhir: ') }}
                                                    {{ $payment->updated_at->format('d M Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="italic text-xs text-center text-gray-900 dark:text-gray-100">
                                            {{ __('Belum ada pembayaran...') }}
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="border-b border-dashed dark:border-gray-400"></div>

                            <!-- Total Belanja -->
                            <div class="flex justify-between">
                                <div class="text-gray-900 dark:text-gray-100 text-sm font-bold">
                                    {{ __('Total Belanja') }}
                                </div>
                                <div class="text-gray-900 dark:text-gray-100 text-sm font-bold">
                                    Rp @rupiah($order->total_harga)
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
