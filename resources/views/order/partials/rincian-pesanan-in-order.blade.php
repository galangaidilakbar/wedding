<section class="mb-6 max-w-xl border border-dashed bg-gray-50 dark:bg-gray-900 px-6 py-4 rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Rincian Pesanan') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mohon ditinjau kembali sebelum membuat pesanan.") }}
        </p>
    </header>

    <div class="grid grid-cols-2 gap-2 max-w-xl mt-6">
        <div class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Subtotal Untuk Produk') }}</div>
        <div>Rp @rupiah($total_product_price)</div>

        <div class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Jenis Pembayaran') }}</div>
        <div x-show="jenis_pembayaran === 'dp'">{{ __('DP 30%') }}</div>
        <div x-show="jenis_pembayaran === 'bayar_penuh'">{{ __('Bayar Penuh') }}</div>

        <div class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Total Pembayaran') }}</div>
        <div class="text-gray-900 dark:text-white text-2xl font-bold text-gray-900 dark:text-white"
             x-show="jenis_pembayaran === 'dp'">
            Rp @rupiah($total_pembayaran)
        </div>
        <div class="text-gray-900 dark:text-white text-2xl font-bold text-gray-900 dark:text-white"
             x-show="jenis_pembayaran === 'bayar_penuh'">
            Rp @rupiah($total_product_price)
        </div>
    </div>
</section>
