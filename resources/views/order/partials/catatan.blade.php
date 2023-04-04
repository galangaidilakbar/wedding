<div class="mb-6 max-w-xl">
    <x-input-label for="catatan" :value="__('Catatan')"/>
    <x-textarea class="mt-4 block w-full"
                id="catatan"
                name="catatan"
                placeholder="Mohon tinggalkan catatan...">{{ old('catatan') }}</x-textarea>
    <x-input-error class="mt-2" :messages="$errors->get('catatan')"/>
</div>
