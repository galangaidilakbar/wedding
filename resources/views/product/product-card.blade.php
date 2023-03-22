<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center">
    @foreach($products as $product)
        <div
            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="p-8 rounded-t-lg" src="{{ $product->photo_url }}" alt="product image" height="100"/>
            </a>
            <div class="px-5 pb-5">
                <a href="{{ route('product.show', $product) }}">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
                </a>

                <div class="flex items-center justify-between">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">Rp @rupiah($product->price)</span>
                    <form action="{{ route('cart.store') }}" method="post">
                        @csrf

                        <input type="hidden" value="{{ $product->id }}" id="product_id" name="product_id">

                        <x-primary-button>
                            Add to cart
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Menampilkan Toast -->
@if(session('cart-saved'))
    <div
        class="absolute flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow right-5 bottom-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
        role="alert"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)">
        <div class="text-sm text-gray-600 dark:text-gray-400">{{ session('cart-saved') }}</div>
    </div>
@endif
