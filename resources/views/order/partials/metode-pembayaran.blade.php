<section class="mb-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Metode Pembayaran') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mohon memilih metode pembayaran.") }}
        </p>
    </header>

    <div class="flex mt-4 justify-between lg:justify-start space-x-8 max-w-xl">
        <div>
            <input type="radio" id="cash" name="metode_pembayaran" value="cash" checked>
            <label for="cash">Cash (👍)</label>
        </div>

        <div class="border-l dark:border-gray-500"></div>

        <div>
            <input type="radio" id="transfer_bank" name="metode_pembayaran" value="transfer_bank">
            <label for="transfer_bank">Transfer Bank</label>
        </div>

        <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2"/>
    </div>
</section>
