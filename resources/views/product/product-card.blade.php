<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center">
    @foreach ($products as $product)
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-700">
            <a href="{{ route('product.show', $product) }}">
                <img class="rounded-t-lg" src="{{ $product->photo_url }}" alt="{{ $product->name }}" loading="lazy"/>
            </a>
            <div class="px-5 py-5">
                <a href="{{ route('product.show', $product) }}">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white mb-5 text-center hover:underline">{{ $product->name }}</h5>
                </a>

                <h3 class="text-base font-bold text-gray-900 dark:text-white text-center">Rp @rupiah($product->price)</h3>
            </div>
        </div>
    @endforeach
</section>
