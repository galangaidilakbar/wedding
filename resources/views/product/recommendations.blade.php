<h6 class="text-lg font-bold dark:text-white mb-6">
    {{ __('Rekomendasi untukmu') }}
</h6>


<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center">
    @forelse($recommendations as $product)
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
        <div></div>
    @endforelse
</div>
