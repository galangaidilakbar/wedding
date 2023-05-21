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
                                {{ __('Perbarui informasi suatu produk.') }}
                            </p>
                        </header>

                        <form method="post"
                              action="{{ route('admin.products.update', $product) }}"
                              class="mt-6 space-y-6"
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
                                       accept=".png, .jpeg, .jpg">
                                <img src="{{ $product->photo_url }}" alt="Gambar Produk {{ $product->name }}"
                                     class="mt-3 max-w-full h-auto rounded-lg bg-contain">
                                <x-input-error class="mt-2" :messages="$errors->get('photo')"/>
                            </div>

                            <div>
                                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{ __('Kategori') }}</h3>
                                <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach($categories as $category)
                                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                            <div class="flex items-center pl-3">
                                                <input id="{{ $category->id }}"
                                                       name="categories[]"
                                                       type="checkbox"
                                                       value="{{ $category->id }}"
                                                       {{ $product->categories->contains($category) ? 'checked' : ''}}
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="{{ $category->id }}"
                                                       class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
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
