<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section x-data="{ name: '' }">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Tambah Produk') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Lorem ipsum dolor sit amet.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('product.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Nama Produk')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name')" required autofocus autocomplete="name" x-model="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="category_id" :value="__('Kategori Produk')" />
                                <x-select name="category_id" id="category_id" class="mt-1 block w-full">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Harga')" />
                                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                                              :value="old('price')" onchange="rupiah(this.value)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Deskripsi')" />
                                <x-textarea id="description" name="description" class="mt-1 block w-full">{{ old('description') }}</x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('detail')" />
                            </div>

                            <div>
                                <x-input-label for="photo" :value="__('Foto Produk')" />
                                <input type="file" name="photo" id="photo"
                                    class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-400 file:text-indigo-700 dark:file:text-indigo-100
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500"
                                    accept=".png, .jpeg, .jpg" onchange="showPreview(event)">
                                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                            </div>



                            <div class="grid grid-cols-2 gap-4" x-data="{ open: false }">
                                <div class="text-gray-900 dark:text-white">
                                    <strong>Preview Produk</strong>
                                </div>
                                <div class="justify-self-end text-gray-900 dark:text-white">
                                    <button type="button" @click="open = ! open">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-span-2" x-show="open" x-transition>
                                    <div
                                        class="w-full max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <a href="#">
                                            <img class="p-8 rounded-t-lg" id="file-ip-1-preview" />
                                        </a>
                                        <div class="px-5 pb-5">
                                            <a href="#">
                                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"
                                                    x-text="name"></h5>
                                            </a>
                                            <div class="flex items-center justify-between mt-2">
                                                <span class="text-2xl font-bold text-gray-900 dark:text-white" id="pricePreview"></span>
                                                <a href="#"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Pesan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
            }
        }

        const rupiah = (number) => {
            let formatted =  new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);

            return document.getElementById("pricePreview").innerText = formatted
        }
    </script>
</x-app-layout>
