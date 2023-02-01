<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Tambah Alamat') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Alamat ini akan digunakan sebagai tempat lokasi acara pernikahan.") }}
                            </p>
                        </header>

                        <section class="mt-6">
                            <div id="map" class="h-96"></div>

                            <button class="mt-1 inline-flex items-center space-x-1 text-sm text-gray-600 dark:text-gray-400"
                                    type="button"
                                    onclick="getCurrentLocation()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                          d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>{{__('Gunakan lokasi saat ini')}}</span>
                            </button>
                        </section>

                        <form method="post" action="{{ route('address.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="accuracy" name="accuracy">

                            <div>
                                <x-input-label for="name" :value="__('Nama')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name')" required autofocus autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div>
                                <x-input-label for="detail" :value="__('Detail Alamat')"/>
                                <x-text-input id="detail" name="detail" type="text" class="mt-1 block w-full"
                                              :value="old('detail')" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('detail')"/>
                            </div>

                            <div>
                                <x-input-label for="keterangan" :value="__('Keterangan (opsional)')"/>
                                <x-text-input id="keterangan" name="keterangan" type="text" class="mt-1 block w-full"
                                              :value="old('keterangan')"/>
                                <x-input-error class="mt-2" :messages="$errors->get('keterangan')"/>
                                <span class="text-xs text-gray-600 dark:text-gray-400">{{__('Tambahkan ini biar kami lebih mudah menemukan alamat mu')}}</span>
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
        const map = L.map('map').setView([-1.933, 115.203], 4);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        function success(pos) {
            const crd = pos.coords;
            map.flyTo([crd.latitude, crd.longitude], 13);
            const marker = L.marker([crd.latitude, crd.longitude]).addTo(map);
            marker.bindPopup(`Tingkat akurasi ${crd.accuracy} meter.`).openPopup();

            document.getElementById("latitude").value = `${crd.latitude}`
            document.getElementById("longitude").value = `${crd.longitude}`
            document.getElementById("accuracy").value = `${crd.accuracy}`
        }

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        }

        function getCurrentLocation() {
            navigator.geolocation.getCurrentPosition(success, error, options);
        }
    </script>
</x-app-layout>
