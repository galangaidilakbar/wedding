<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.product detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Product image --}}
                        <div>
                            <img src="{{ $product->photo_url }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover rounded-lg">
                        </div>

                        {{-- Product details --}}
                        <div>
                            <h1 class="text-2xl mb-3 leading-none font-semibold text-gray-900 dark:text-white">
                                {{ $product->name }}</h1>

                            <div class="text-lg font-medium text-gray-500 dark:text-gray-400 mb-3">
                                Rp @rupiah($product->price)
                            </div>

                            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line">
                                {{ $product->description }}
                            </p>

                            <div class="mt-4">
                                <form action="{{ route('cart.store') }}" method="post" class="hidden md:block">
                                    @csrf

                                    <input type="hidden" value="{{ $product->id }}" id="product_id" name="product_id">

                                    <x-primary-button>
                                        {{ __('translations.add to cart') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>

                        <div class="grid-cols-2 md:hidden relative">
                            <form action="{{ route('cart.store') }}" method="post" class="fixed bottom-0 inset-x-0 p-4">
                                @csrf

                                <input type="hidden" value="{{ $product->id }}" id="product_id" name="product_id">

                                <x-primary-button class="w-full flex justify-center">
                                    <span>{{ __('translations.add to cart') }}</span>
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
