<section class="mb-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Jenis Pembayaran') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mohon memilih jenis pembayaran.") }}
        </p>
    </header>

    <div class="flex mt-4 justify-between lg:justify-start space-x-8 max-w-xl">
        <div>
            <input type="radio" id="dp" name="jenis_pembayaran" value="dp" checked x-model="jenis_pembayaran">
            <label for="dp">{{ __('DP 30% (👍)') }}</label>
        </div>

        <div class="border-l dark:border-gray-500"></div>

        <div>
            <input type="radio" id="bayar_penuh" name="jenis_pembayaran" value="bayar_penuh" x-model="jenis_pembayaran">
            <label for="bayar_penuh">{{ __('Bayar penuh') }}</label>
        </div>

        <x-input-error :messages="$errors->get('jenis_pembayaran')" class="mt-2"/>
    </div>
</section>
