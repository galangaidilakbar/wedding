<section class="mb-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Produk Dipesan') }}
        </h2>
    </header>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Harga
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts as $cart)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-32 p-4">
                        <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}">
                    </td>
                    <td class="px-6 py-4">
                        {{ $cart->product->name }}
                    </td>
                    <td class="px-6 py-4">
                        Rp @rupiah($cart->product->price)
                    </td>
                </tr>
            @endforeach
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4" colspan="2">
                    {{ __('Total Pesanan') }}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    Rp @rupiah($total_product_price)
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
