<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <!-- Search bar -->
                    <div class="w-full lg:w-auto lg:flex-1">
                        <x-search-bar to="{{ route('order.index') }}" placeholder="Cari pesananmu di sini"/>
                    </div>

                    <!-- Filter by status-->
                    <form
                        action="{{ route('order.index') }}"
                        method="get"
                        class="mt-2 lg:mt-0 w-full lg:w-auto"
                        onchange="this.closest('form').submit()">

                        <x-input-label
                            for="status"
                            value="status"
                            class="sr-only"/>

                        <x-select
                            id="status"
                            name="status"
                            class="mt-1 block w-full"
                            required>
                            <option value="" disabled>-- Status --</option>
                            @foreach(App\Models\Order::ORDER_STATUS as $value)
                                <option
                                    value="{{ $value }}"
                                    {{ request('status') === $value ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </x-select>
                    </form>

                    <!-- Filter by date -->
                    <form
                        action="{{ route('order.index') }}"
                        method="get"
                        class="w-full lg:w-auto">
                        <div class="mt-2 lg:mt-0 flex items-center" x-data="{open: false}">
                            <div class="relative w-full lg:w-auto">
                                <label for="select_date" class="sr-only"></label>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text"
                                       id="select_date"
                                       x-on:click.prevent="$dispatch('open-modal', 'select-range-date')"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Pilih tanggal transaksi"
                                       value="{{ request('start') ? request('start') . ' - ' . request('end') : 'Pilih tanggal transaksi'}}">
                            </div>
                        </div>
                        <!-- Modal to open date range -->
                        <x-modal name="select-range-date" x-show="open" focusable>
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Pilih tanggal') }}
                                </h2>

                                <div class="flex items-center mt-6 justify-start">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <label for="start" class="sr-only">Tanggal awal</label>
                                        <input name="start" type="date" id="start"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="Select date start" value="{{ request('start') }}">
                                    </div>
                                    <span class="mx-4 text-gray-500">-</span>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <label for="end" class="sr-only">Tanggal akhir</label>
                                        <input name="end" type="date" id="end"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="Select date end" value="{{ request('end') }}">
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('translations.Cancel') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ml-3">
                                        {{ __('Submit') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </x-modal>
                    </form>
                </div>
            </div>

            @forelse($orders as $order)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 mt-6 first:mt-0 space-y-6">
                        <!-- Header -->
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4 justify-between items-center lg:justify-start w-full lg:w-auto">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $order->created_at->format('d M Y') }}
                                </div>

                                <x-badge-status :text="$order->status" :color="$order->status_color"/>

                                <div class="text-sm text-gray-500 dark:text-gray-400 hidden lg:block select-all">
                                    {{ $order->id }}
                                </div>
                            </div>
                            <x-primary-link href="{{ route('order.show', $order) }}" class="hidden lg:block text-sm">
                                {{ __('Lihat Detail Pesanan') }}
                            </x-primary-link>
                        </div>

                        <div class="border-b border-dashed dark:border-gray-700"></div>

                        <!-- Products -->
                        <div class="grid grid-cols-1">
                            @foreach ($order->detail_orders as $cart)
                                <div class="flex space-x-8">
                                    <div class="w-32">
                                        <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}"
                                             class="rounded" loading="lazy">
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm lg:text-base font-medium text-gray-900 dark:text-gray-100">
                                            {{ $cart->product->name }}
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400 lg:hidden text-xs mt-1">
                                            Rp @rupiah($cart->product->price)
                                        </div>
                                    </div>
                                    <div class="hidden lg:block text-gray-600 dark:text-gray-400">
                                        Rp @rupiah($cart->product->price)
                                    </div>
                                </div>
                                @if($loop->count > 1)
                                    <div class="w-auto mt-2">
                                        <button class="text-gray-500 dark:text-gray-400 text-sm">
                                            +{{$loop->count - 1}} produk lainnya
                                        </button>
                                    </div>
                                @endif

                                @break($loop->iteration === 1)
                            @endforeach
                        </div>

                        <div class="border-b border-dashed dark:border-gray-700"></div>

                        <!-- Total transaction in dekstop-->
                        <div class="hidden lg:block text-right">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Total Pesanan: ') }}
                            </div>
                            <div class="font-bold text-gray-900 dark:text-gray-100">
                                Rp @rupiah($order->total_harga)
                            </div>
                        </div>

                        <!-- Total transaction in mobile-->
                        <div class="flex justify-between items-center lg:hidden">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Total Pesanan: ') }}
                                <div class="text-sm font-semibold">
                                    Rp @rupiah($order->total_harga)
                                </div>
                            </div>
                            <x-primary-link href="{{ route('order.show', $order) }}" class="text-sm">
                                {{ __('Lihat Detail Pesanan') }}
                            </x-primary-link>
                        </div>
                    </div>
                </div>
            @empty
                <figure class="flex flex-col justify-center items-center">
                    <img src="{{ asset('img/empty.svg') }}" alt="empty illustration" class="w-20 h-auto">
                    <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">Tidak ada pesanan</figcaption>
                </figure>
            @endforelse

            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
