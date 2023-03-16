<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex-1">
            {{ __('Ubah Kategori Produk') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Perbarui kategori produk.") }}
        </p>
    </header>

    <form method="post" action="{{ route('category.update', $category) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="name" :value="__('Nama Kategori')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$category->name" autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('translations.Save') }}</x-primary-button>

            @if (session('category-saved'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
