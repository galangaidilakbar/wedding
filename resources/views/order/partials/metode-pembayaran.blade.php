<section class="mb-6 max-w-xl">
    <x-input-label :value="__('Metode Pembayaran')"/>

    <div class="grid grid-cols-1 space-y-6 mt-4">
        {{-- CASH --}}
        <div
            class="flex items-center space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <input class="grow-0" type="radio" id="CASH" name="metode_pembayaran" value="CASH" checked>
            <div class="flex-1">
                <label for="CASH">{{ __('DP (Direkomendasikan)') }}</label>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Bayar langsung di kantor.') }}
                </p>
            </div>
        </div>

        {{-- BANK --}}
        <div
            class="flex items-center space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <input class="grow-0" type="radio" id="BANK" name="metode_pembayaran" value="BANK">
            <div class="flex-1">
                <label for="BANK">{{ __('Transfer Bank') }}</label>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Bayar via transfer bank.') }}
                </p>
            </div>
        </div>
    </div>

    <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2"/>
</section>

