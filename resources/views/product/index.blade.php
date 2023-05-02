<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Search bar -->
                    <div class="mb-4">
                        <x-search-bar to="{{ route('products.search') }}" placeholder="Cari produk..."/>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center">
                        @forelse($products as $product)
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

                                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Rp
                                        @rupiah($product->price)</h3>
                                </div>
                            </div>
                        @empty
                            <figure class="col-span-3 flex flex-col justify-center items-center">
                                <img src="{{ asset('img/empty.svg') }}" alt="empty illustration" class="w-20 h-auto">
                                <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">
                                    Produk tidak ditemukan.
                                </figcaption>
                            </figure>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 dark:text-gray-400">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


