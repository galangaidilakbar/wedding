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
                    <x-primary-button-link href="{{ route('admin.products.create') }}">
                        {{ __('Tambah Produk') }}
                    </x-primary-button-link>

                    <!-- Search bar -->
                    <div class="my-4">
                        <x-search-bar to="{{ route('admin.products.index') }}" placeholder="Cari produk..."/>
                    </div>

                    @include('admin.product.partials.list-products')

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
