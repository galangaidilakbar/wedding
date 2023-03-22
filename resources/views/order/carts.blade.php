<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <section>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Image</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Produk
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($carts as $cart)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="w-32 p-4">
                                            <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $cart->product->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp @rupiah($cart->product->price)
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="POST" action="{{ route('cart.destroy', $cart) }}">
                                                @csrf
                                                @method('delete')
                                                <x-primary-link href="{{ route('cart.destroy', $cart) }}"
                                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Hapus
                                                </x-primary-link>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td colspan="6" class="px-6 py-4">
                                            <figure class="flex flex-col justify-center items-center">
                                                <img src="{{ asset('img/undraw_empty_cart.svg') }}"
                                                     alt="empty illustration" class="w-20 h-auto">
                                                <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">
                                                    Keranjang belanja masih kosong
                                                </figcaption>
                                            </figure>
                                        </td>
                                    </tr>
                                @endforelse
                                @if($total_price > 0)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white font-semibold">
                                            Total
                                        </th>
                                        <td class="px-6 py-4 text-gray-900 dark:text-white font-semibold" colspan="3">
                                            Rp @rupiah($total_price)
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-primary-button>
                                                Checkout
                                            </x-primary-button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>