<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Kategori
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Produk
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('categories.show', $category) }}"
                                           class="text-blue-500 dark:text-blue-400 hover:underline">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        {{ $category->products_count }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td colspan="3" class="px-6 py-4">
                                        <figure class="flex flex-col justify-center items-center">
                                            <img src="{{ asset('img/empty.svg') }}" alt="empty illustration"
                                                 class="w-20 h-auto">
                                            <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">Data
                                                kategori produk masih kosong
                                            </figcaption>
                                        </figure>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
