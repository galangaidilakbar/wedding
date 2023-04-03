<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('order.store') }}" method="post">
                        @csrf

                        <!-- Alamat -->
                        @include('order.partials.address-for-order')

                        <!-- Produk Dipesan -->
                        @include('order.partials.products-for-order')

                        <!-- Tanggal Acara -->
                        @include('order.partials.tanggal-acara')

                        <!-- Jenis Pembayaran -->
                        @include('order.partials.opsi-bayar')

                        <!-- Metode Pembayaran -->
                        @include('order.partials.metode-pembayaran')

                        <!-- Catatan -->
                        @include('order.partials.catatan')

                        <x-primary-button>{{ __('Buat Pesanan') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
