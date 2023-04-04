<section class="mb-6 max-w-xl">
    <x-input-label :value="__('Alamat Acara')"/>

    <div class="flex flex-col">
        @foreach($addresses as $address)
            <div class="flex items-center space-x-8 mt-4 bg-gray-50 dark:bg-gray-900 px-6 py-4 rounded-lg border dark:border-gray-700">
                <input type="radio" id="{{ $address->id }}" name="address_id" value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }}>

                <div class="flex flex-1">
                    <div class="flex-1">
                        <label for="{{ $address->id }}"
                               class="text-gray-900 dark:text-white">{{ $address->full_name }}</label>
                        <span class="border-l dark:border-gray-600 ml-2"></span>
                        <span class="text-gray-600 dark:text-gray-400 text-sm ml-2">{{ $address->phone_number }}</span>

                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            {{ $address->detail }} ({{ $address->patokan }})
                        </div>
                    </div>
                    <x-primary-link href="{{ route('address.edit', $address) }}" class="hidden lg:block">
                        Ubah
                    </x-primary-link>
                </div>
            </div>
        @endforeach

        <x-input-error :messages="$errors->get('address_id')" class="mt-2"/>
    </div>
</section>
