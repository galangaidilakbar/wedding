<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reschedule Acara') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-xl">
                        <div class="grid grid-cols-1">
                            <form action="{{ route('order.reschedule.store', $order) }}"
                                  method="post"
                                  class="w-full space-y-6">
                                @csrf

                                <!-- Order id -->
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                                        {{ __('No. Pesanan') }}
                                    </div>
                                    <div class="text-gray-900 dark:text-gray-400 text-sm">
                                        {{ $order->id }}
                                    </div>
                                </div>

                                <!-- Tanggal Acara lama-->
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                                        {{ __('translations.Event date') }}
                                    </div>
                                    <div class="text-gray-900 dark:text-gray-100 text-sm">
                                        {{ $order->tanggal_acara->format('d F Y') }}
                                    </div>
                                </div>

                                <!-- Tanggal Acara yang baru-->
                                <div>
                                    <x-input-label for="new_date" :value="__('Ganti ke tanggal')"/>
                                    <x-text-input id="new_date" class="block mt-1 w-full" type="date" name="new_date"
                                                  :value="old('new_date')" required autofocus/>
                                    <x-input-error :messages="$errors->get('new_date')" class="mt-2"/>
                                </div>

                                <!-- Alasan -->
                                <div>
                                    <x-input-label for="reason"
                                                   :value="__('Kenapa anda ingin mengubah tanggal acara')"/>

                                    <x-textarea
                                        name="reason"
                                        id="reason"
                                        value="{{ old('reason') }}"
                                        class="block mt-1 w-full"></x-textarea>

                                    <x-input-error :messages="$errors->get('reason')" class="mt-2"/>
                                </div>

                                <!-- Submit button -->
                                <div class="flex justify-end space-x-4 items-center">
                                    <x-secondary-button-link href="{{ URL::previous() }}">
                                        Batal
                                    </x-secondary-button-link>

                                    <x-primary-button type="submit">
                                        {{ __('Ajukan Reschedule') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
