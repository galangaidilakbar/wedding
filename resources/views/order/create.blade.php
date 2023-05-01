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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="col-span-1 lg:col-span-2">
                        <div class="space-y-6 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <!-- Tanggal -->
                            <section>
                                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                                    Tanggal acara
                                </h3>
                                <x-text-input id="tanggal_acara" class="block w-full max-w-xl" type="date"
                                              name="tanggal_acara"
                                              required/>
                                <x-input-error :messages="$errors->get('tanggal_acara')" class="mt-2"/>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    Pastikan tanggal acara yang Anda pilih minimal 2 minggu dari hari ini.
                                </p>
                            </section>

                            <!-- Alamat -->
                            <section>
                                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                                    Alamat acara
                                </h3>

                                <ul class="grid w-full gap-6 md:grid-cols-2">
                                    @forelse($addresses as $address)
                                        <li>
                                            <input type="radio" id="{{ $address->id }}" name="address_id"
                                                   value="{{ $address->id }}"
                                                   class="hidden peer" required {{ $loop->first ? 'checked' : '' }}>
                                            <label for="{{ $address->id }}"
                                                   class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div
                                                        class="w-full text-lg font-semibold">{{ $address->full_name }}</div>
                                                    <div class="w-full text-xs">{{ $address->phone_number }}</div>
                                                    <div class="w-full text-xs mt-2">
                                                        {{ $address->detail }}
                                                        ({{ $address->patokan }})
                                                    </div>
                                                </div>
                                            </label>
                                        </li>
                                    @empty
                                        <div class="text-gray-500 dark:text-gray-400 text-sm">
                                            Tambah alamat terlebih dahulu.
                                            <x-primary-link href="{{ route('address.create') }}">
                                                Tambah Alamat
                                            </x-primary-link>
                                        </div>
                                    @endforelse
                                </ul>

                                @unless($addresses->isEmpty())
                                    <div class="mt-4 text-gray-500 dark:text-gray-400 text-xs">
                                        Bukan disini?
                                        <x-primary-link href="{{ route('address.create') }}">
                                            Tambah Alamat
                                        </x-primary-link>
                                    </div>
                                @endunless
                            </section>

                            <!-- Opsi Bayar -->
                            <section>
                                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                                    Bayar Penuh atau DP?
                                </h3>

                                <ul class="grid w-full gap-6 md:grid-cols-2">
                                    <li>
                                        <input type="radio" id="dp" name="opsi_bayar" value="DP"
                                               class="hidden peer" required checked>
                                        <label for="dp"
                                               class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">DP 30%</div>
                                                <div class="w-full">Bayar uang muka</div>
                                            </div>
                                            <svg aria-hidden="true" class="w-6 h-6 ml-3" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                    </li>

                                    <li>
                                        <input type="radio" id="FULL" name="opsi_bayar" value="FULL"
                                               class="hidden peer">
                                        <label for="FULL"
                                               class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Bayar Penuh</div>
                                                <div class="w-full">Bayar harga total</div>
                                            </div>
                                            <svg aria-hidden="true" class="w-6 h-6 ml-3" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                    </li>
                                </ul>

                                <x-input-error :messages="$errors->get('opsi_bayar')" class="mt-2"/>
                            </section>

                            <!-- Metode pembayararan -->
                            <section>
                                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                                    Bayar pake apa?
                                </h3>
                                <ul class="grid w-full gap-6 md:grid-cols-2">
                                    <li>
                                        <input type="radio" id="cash" name="metode_pembayaran" value="cash"
                                               class="hidden peer" required checked>
                                        <label for="cash"
                                               class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Cash</div>
                                                <div class="w-full">Bayar ke kantor</div>
                                            </div>
                                            <svg aria-hidden="true" class="w-6 h-6 ml-3" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                    </li>

                                    <li>
                                        <input type="radio" id="bank" name="metode_pembayaran" value="bank"
                                               class="hidden peer">
                                        <label for="bank"
                                               class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Transfer</div>
                                                <div class="w-full">Bayar via bank transfer.</div>
                                            </div>
                                            <svg aria-hidden="true" class="w-6 h-6 ml-3" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                    </li>
                                </ul>

                                <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2"/>
                            </section>
                        </div>
                    </div>

                    <div class="col-span-1">
                        <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pesananmu</h3>

                            @foreach($carts as $cart)
                                <div class="flex gap-4 mt-2 border-t py-6">
                                    <div class="w-32">
                                        <img src="{{ $cart->product->photo_url }}"
                                             class="rounded"
                                             alt="{{ $cart->product->name }}">
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-gray-900 dark:text-white">{{ $cart->product->name }}</div>
                                        <div class="text-gray-600 dark:text-gray-400 text-sm">
                                            Rp @rupiah($cart->product->price)
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <section>
                                <x-input-label for="catatan" :value="__('Catatan')"/>
                                <x-text-input id="catatan" class="block mt-1 w-full" type="text" name="catatan"
                                              :value="old('catatan')"/>
                                <x-input-error class="mt-2" :messages="$errors->get('catatan')"/>
                            </section>

                            <div class="flex justify-between items-center mt-4">
                                <div class="text-gray-900 dark:text-white font-semibold">Total</div>
                                <div class="text-gray-900 dark:text-white font-semibold">Rp
                                    @rupiah($total_product_price)
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <x-secondary-button-link href="{{ route('cart.index') }}">
                                    {{ __('translations.Cancel') }}
                                </x-secondary-button-link>

                                <x-primary-button>
                                    {{ __('Buat Pesanan') }}
                                </x-primary-button>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
