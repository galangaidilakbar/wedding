<section>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Kategori
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
            @forelse($products as $key => $product)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $products->firstItem() + $key }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->category->name }}
                    </td>
                    <td class="px-6 py-4">
                        Rp @rupiah($product->price)
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <x-primary-link href="{{ route('admin.products.edit', $product) }}">
                            Ubah
                        </x-primary-link>

                        <div class="border-l"></div>

                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                            @csrf
                            @method('delete')
                            <x-primary-link href="{{ route('address.destroy', $product) }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                Hapus
                            </x-primary-link>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="5" class="px-6 py-4">
                        <figure class="flex flex-col justify-center items-center">
                            <img src="{{ asset('img/empty.svg') }}" alt="empty illustration" class="w-20 h-auto">
                            <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">Data produk masih kosong
                            </figcaption>
                        </figure>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
