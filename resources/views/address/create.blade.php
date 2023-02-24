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
                        </section>

                        <form method="post" action="{{ route('address.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="accuracy" name="accuracy">

                            <div>
                                <x-input-label for="name" :value="__('Nama Tempat')"/>
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
                                <span
                                    class="text-xs text-gray-600 dark:text-gray-400">{{__('Tambahkan ini biar kami lebih mudah menemukan alamat mu')}}</span>
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
        const map = L.map('map').fitWorld()

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        map.locate({setView: true, maxZoom: 16});

        function onLocationFound(e) {
            const radius = e.accuracy;

            L.marker(e.latlng).addTo(map)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();

            L.circle(e.latlng, radius).addTo(map);

            document.getElementById("latitude").value = e.latlng.lat
            document.getElementById("longitude").value = e.latlng.lng
            document.getElementById("accuracy").value = e.accuracy
        }

        map.on('locationfound', onLocationFound);

        function onLocationError(e) {
            alert(e.message);
        }

        map.on('locationerror', onLocationError);
    </script>
</x-app-layout>
