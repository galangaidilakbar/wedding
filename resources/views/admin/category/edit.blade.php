<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex-1">
                                {{ __('Ubah Kategori Produk') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Perbarui kategori produk.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('admin.categories.update', $category) }}"
                              class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="name" :value="__('Nama Kategori')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="$category->name" autofocus/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('translations.Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
