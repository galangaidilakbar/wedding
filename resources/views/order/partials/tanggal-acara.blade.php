<section class="mb-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Tanggal Acara') }}
        </h2>
    </header>
    <div class="max-w-xl">
        <x-input-label for="tanggal_acara" :value="__('Mohon memilih tanggal acara.')"/>
        <x-text-input id="tanggal_acara" class="block mt-4 w-full" type="date" name="tanggal_acara" required/>
        <x-input-error :messages="$errors->get('tanggal_acara')" class="mt-2"/>
    </div>
</section>
