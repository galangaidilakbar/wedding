<section class="mb-6 max-w-xl">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Opsi Bayar') }}
        </h2>
    </header>

    <div class="grid grid-cols-1 space-y-6 mt-4">
        {{-- DP --}}
        <div class="flex space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <div class="flex-shrink-0">
                <input type="radio" id="DP" name="opsi_bayar" value="DP" checked>
            </div>
            <label class="flex-1" for="DP">
                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ __('DP (Direkomendasikan)') }}
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Bayar DP sebesar 30% dari total harga.') }}
                </div>
            </label>
        </div>

        {{-- FULL --}}
        <div class="flex space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <div class="flex-shrink-0">
                <input type="radio" id="FULL" name="opsi_bayar" value="FULL">
            </div>
            <label for="FULL" class="flex-1">
                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Full') }}
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Bayar total harga.') }}
                </div>
            </label>
        </div>
    </div>

    <x-input-error :messages="$errors->get('opsi_bayar')" class="mt-2"/>
</section>
