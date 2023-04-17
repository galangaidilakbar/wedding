<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex-1">
            {{ __('Semua Kategori') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Menampilkan semua kategori produk.") }}
        </p>
    </header>

    <!-- Flash Message: Update Category -->
    @if (session('status') === 'updated')
        <div x-data="{ show: true }"
             x-show="show"
             x-transition
             x-init="setTimeout(() => show = false, 5000)"
             class="p-4 mb-4 mt-1 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
             role="alert">
            {{ 'Kategori berhasil ' . __('translations.Updated') }}
        </div>
    @endif

    <!-- Flash Message: Delete Category -->
    @if (session('status') === 'deleted')
        <div x-data="{ show: true }"
             x-show="show"
             x-transition
             x-init="setTimeout(() => show = false, 5000)"
             class="p-4 mb-4 mt-1 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
             role="alert">
            {{ 'Kategori berhasil ' . __('translations.Deleted') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Kategori
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $category->name }} ({{ $category->products_count }})
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <x-primary-link href="{{ route('admin.categories.edit', $category) }}">
                            Ubah
                        </x-primary-link>

                        <div class="border-l"></div>

                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf
                            @method('delete')

                            <button type="submit"
                                    {{ $category->products_count ? 'disabled' : '' }} class="font-medium text-blue-600 dark:text-blue-500 hover:underline {{ $category->products_count ? 'cursor-not-allowed opacity-50': '' }}">
                                {{ __('Hapus')  }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="3" class="px-6 py-4">
                        <figure class="flex flex-col justify-center items-center">
                            <img src="{{ asset('img/empty.svg') }}" alt="empty illustration" class="w-20 h-auto">
                            <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">Data kategori produk masih
                                kosong
                            </figcaption>
                        </figure>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
