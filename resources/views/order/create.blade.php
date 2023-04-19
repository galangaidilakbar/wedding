<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('order.store') }}" method="post" class="space-y-6">
                @csrf

                <!-- Alamat acara -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <x-input-label :value="__('Alamat Acara')"/>

                            <div class="flex flex-col">
                                @forelse($addresses as $address)
                                    <div
                                        class="flex items-center space-x-8 mt-4 bg-gray-50 dark:bg-gray-900 px-6 py-4 rounded-lg border dark:border-gray-700">
                                        <input type="radio" id="{{ $address->id }}" name="address_id"
                                               value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }}>

                                        <div class="flex flex-1">
                                            <div class="flex-1">
                                                <label for="{{ $address->id }}"
                                                       class="text-gray-900 dark:text-white">{{ $address->full_name }}</label>
                                                <span class="border-l dark:border-gray-600 ml-2"></span>
                                                <span
                                                    class="text-gray-600 dark:text-gray-400 text-sm ml-2">{{ $address->phone_number }}</span>

                                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                                    {{ $address->detail }} ({{ $address->patokan }})
                                                </div>
                                            </div>
                                            <x-primary-link href="{{ route('address.edit', $address) }}"
                                                            class="hidden lg:block">
                                                Ubah
                                            </x-primary-link>
                                        </div>
                                    </div>
                                @empty
                                    <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm">
                                        Tambah alamat terlebih dahulu.
                                        <x-primary-link href="{{ route('address.create') }}">
                                            Tambah Alamat
                                        </x-primary-link>
                                    </div>
                                @endforelse

                                <x-input-error :messages="$errors->get('address_id')" class="mt-2"/>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Tanggal acara -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <x-input-label for="tanggal_acara" :value="__('Tanggal Acara')"/>
                            <x-text-input id="tanggal_acara" class="block mt-4 w-full" type="date" name="tanggal_acara"
                                          required/>
                            <x-input-error :messages="$errors->get('tanggal_acara')" class="mt-2"/>
                        </section>
                    </div>
                </div>

                <!-- Produk dipesan -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <x-input-label :value="__('Produk Dipesan')"/>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Image</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Produk
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Harga
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-32 p-4">
                                                <img src="{{ $cart->product->photo_url }}"
                                                     alt="{{ $cart->product->name }}">
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $cart->product->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp @rupiah($cart->product->price)
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4" colspan="2">
                                            {{ __('Total Pesanan') }}
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                            Rp @rupiah($total_product_price)
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Opsi Bayar -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
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
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <x-input-label :value="__('Metode Pembayaran')"/>

                            <div class="grid grid-cols-1 space-y-6 mt-4">
                                {{-- CASH --}}
                                <div
                                    class="flex items-center space-x-8 px-6 py-4 bg-gray-50 dark:bg-gray-900 border rounded-lg dark:border-gray-700">
                                    <input class="grow-0" type="radio" id="CASH" name="metode_pembayaran" value="CASH"
                                           checked>
                                    <div class="flex-1">
                                        <label for="CASH">{{ __('CASH') }}</label>
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
                    </div>
                </div>

                <!-- Catatan -->
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <x-input-label for="catatan" :value="__('Catatan')"/>
                            <x-textarea class="mt-4 block w-full"
                                        id="catatan"
                                        name="catatan"
                                        placeholder="Mohon tinggalkan catatan...">{{ old('catatan') }}</x-textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('catatan')"/>
                        </section>

                        <x-primary-button class="mt-4">{{ __('Buat Pesanan') }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
