<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end items-center">
                        <a href="{{ route('product.create') }}"
                            class="inline-flex space-x-2 items-center px-4 py-2 rounded-lg bg-indigo-500 dark:bg-indigo-400 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span class="hidden lg:block">Tambah Produk</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-6 gap-4">
                        @foreach ($products as $product)
                            <div
                                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img class="p-8 rounded-t-lg" src="{{ $product->photo_url }}" />
                                </a>
                                <div class="px-5 pb-5">
                                    <a href="#">
                                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ $product->name }}
                                        </h5>
                                    </a>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                            Rp @rupiah($product->price)
                                        </span>
                                        <a href="#"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
