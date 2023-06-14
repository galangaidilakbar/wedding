<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center flex-wrap gap-4 mb-5">
                        <!-- Search bar -->
                        <div class="w-full lg:w-auto">
                            <x-search-bar to="{{ route('products.search') }}" placeholder="Cari produk..."/>
                        </div>

                        <!-- Filter by status-->
                        <form
                            action=""
                            method="get"
                            class="mt-2 lg:mt-0 w-full lg:w-auto"
                            onchange="this.closest('form').submit()">

                            <x-input-label
                                for="sort"
                                value="Sort"
                                class="sr-only"/>

                            <x-select
                                id="sort"
                                name="sort"
                                class="block w-full"
                                required>
                                <option value="" disabled>Urutkan</option>
                                <option
                                    value="latest"
                                    {{ request('sort') === 'latest' ? 'selected' : '' }}>
                                    Terbaru
                                </option>
                                <option
                                    value="oldest"
                                    {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                                    Terlama
                                </option>
                                <option
                                    value="highest_price"
                                    {{ request('sort') === 'highest_price' ? 'selected' : '' }}>
                                    Harga tertinggi
                                </option>
                                <option
                                    value="lowest_price"
                                    {{ request('sort') === 'lowest_price' ? 'selected' : '' }}>
                                    Harga terendah
                                </option>
                            </x-select>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center">
                        @foreach($products as $product)
                            <div
                                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-700">
                                <a href="{{ route('products.show', $product) }}">
                                    <img class="rounded-t-lg w-full h-72 object-cover" src="{{ $product->photo_url }}"
                                         alt="{{ $product->name }}" loading="lazy"/>
                                </a>
                                <div class="px-5 py-5">
                                    <a href="{{ route('products.show', $product) }}">
                                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white mb-2 hover:underline">{{ $product->name }}</h5>
                                    </a>

                                    <h6 class="text-base font-bold text-gray-900 dark:text-white">
                                        Rp @rupiah($product->price)
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
