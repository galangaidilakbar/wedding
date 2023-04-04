<section class="mb-6 max-w-xl">
    <x-input-label for="tanggal_acara" :value="__('Tanggal Acara')"/>
    <x-text-input id="tanggal_acara" class="block mt-4 w-full" type="date" name="tanggal_acara" required/>
    <x-input-error :messages="$errors->get('tanggal_acara')" class="mt-2"/>
</section>
