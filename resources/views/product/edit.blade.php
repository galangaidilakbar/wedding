<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ubah Produk') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Lorem ipsum dolor sit amet.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('product.update', $product) }}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="name" :value="__('Nama Produk')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name', $product->name)" required autofocus
                                              autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div>
                                <x-input-label for="category_id" :value="__('Kategori Produk')"/>
                                <x-select name="category_id" id="category_id" class="mt-1 block w-full" value="{{ $product->category_id }}">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected($category->id === $product->category_id)>{{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Harga')"/>
                                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                                              :value="old('price', $product->price)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Deskripsi')"/>
                                <x-textarea id="description" name="description"
                                            class="mt-1 block w-full">{{ old('description', $product->description) }}</x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('detail')"/>
                            </div>

                            <div>
                                <x-input-label for="photo" :value="__('Foto Produk')"/>
                                <input type="file" name="photo" id="photo"
                                       class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-400 file:text-indigo-700 dark:file:text-indigo-100
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500"
                                       accept=".png, .jpeg" onchange="showPreview(event)">
                                <img src="{{ $product->photo_url }}" alt="Gambar Produk {{ $product->name }}"
                                     class="mt-1 max-w-full h-auto rounded-lg bg-contain">
                                <x-input-error class="mt-2" :messages="$errors->get('photo')"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
