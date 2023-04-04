<section class="mb-6 max-w-xl">
    <x-input-label :value="__('Opsi Bayar')"/>

    <div class="grid grid-cols-1 space-y-6 mt-4">
        {{-- DP --}}
        <div
            class="flex items-center space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <input class="grow-0" type="radio" id="DP" name="opsi_bayar" value="DP" checked>
            <div class="flex-1">
                <label for="DP">{{ __('DP (Direkomendasikan)') }}</label>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('Buat pesanan dengan membayar sebesar 30% dari total pesanan, kemudian lunasi H-3 sebelum acara.') }}
                </p>
            </div>
        </div>

        {{-- FULL --}}
        <div
            class="flex items-center space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
            <input class="grow-0" type="radio" id="FULL" name="opsi_bayar" value="FULL">
            <div class="flex-1">
                <label for="FULL">{{ __('Full') }}</label>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('Bayar sebesar total pesanan.') }}
                </p>
            </div>
        </div>
    </div>

    <x-input-error :messages="$errors->get('opsi_bayar')" class="mt-2"/>
</section>
