<section class="mb-6 max-w-xl">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Metode Pembayaran') }}
        </h2>
    </header>

    <div class="grid grid-cols-1 space-y-6 mt-4">
        {{-- DP --}}
        <div class="flex space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <div class="flex-shrink-0">
                <input type="radio" id="CASH" name="metode_pembayaran" value="CASH" checked>
            </div>
            <label class="flex-1" for="CASH">
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ __('CASH (Direkomendasikan)') }}
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Bayar langsung di kantor.') }}
                </p>
            </label>
        </div>

        {{-- FULL --}}
        <div class="flex space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <div class="flex-shrink-0">
                <input type="radio" id="BANK" name="metode_pembayaran" value="BANK">
            </div>
            <label for="BANK" class="flex-1">
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Transfer Bank') }}
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Bayar via transfer bank.') }}
                </p>
            </label>
        </div>
    </div>

    <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2"/>
</section>

