<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.product detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-gray-900 dark:text-gray-100">
                    <!-- Product image -->
                    <img src="{{ $product->photo_url }}" alt="{{ $product->name }}"
                         class="w-full h-full max-h-96 object-cover rounded-lg">

                    <div>
                        <!-- Product name -->
                        <h1 class="text-2xl mb-3 leading-none font-semibold text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </h1>

                        <!-- Product price -->
                        <div class="text-lg font-medium text-gray-500 dark:text-gray-400">
                            Rp @rupiah($product->price)
                        </div>

                        <!-- Product description -->
                        <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line">
                            {{ $product->description }}
                        </p>

                        <form action="{{ route('products.cart.store', $product) }}" method="post">
                            @csrf

                            <x-primary-button class="w-full lg:w-auto flex justify-center mt-4">
                                {{ __('translations.add to cart') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('product.recommendations')
            </div>
        </div>
    </div>
</x-app-layout>
