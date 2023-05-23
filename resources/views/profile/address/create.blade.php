<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Alamat Baru') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Alamat ini akan digunakan sebagai tempat lokasi acara pernikahan.") }}
                            </p>
                        </header>

                        <section class="mt-6">
                            <div id="map" class="h-80"></div>
                        </section>

                        <form method="post" action="{{ route('address.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="accuracy" name="accuracy">

                            <div class="grid grid-cols-1 lg:grid-cols-2 space-y-4 lg:space-y-0 lg:space-x-4">
                                <!-- Nama Lengkap -->
                                <div>
                                    <x-input-label for="full_name" :value="__('Nama Lengkap')"/>
                                    <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full"
                                                  :value="old('full_name')" required autofocus autocomplete="name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('full_name')"/>
                                </div>

                                <!-- Nomor telepon -->
                                <div>
                                    <x-input-label for="phone_number" :value="__('Nomor Telepon (Whatsapp)')"/>
                                    <x-text-input id="phone_number" name="phone_number" type="number"
                                                  class="mt-1 block w-full"
                                                  :value="old('phone_number')" required/>
                                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')"/>
                                </div>
                            </div>

                            <!-- Detail alamat -->
                            <div>
                                <x-input-label for="detail" :value="__('Detail Alamat')"/>
                                <x-textarea class="mt-1 block w-full"
                                            id="detail"
                                            name="detail"
                                            placeholder="Tuliskan alamat secara lengkap dimulai dari nama jalan, nomer rumah, RT/RW, Nama Desa, Kecamatan, Kabupaten, dan Provinsi">{{ old('detail') }}</x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('detail')"/>
                            </div>

                            <!-- Patokan -->
                            <div>
                                <x-input-label for="patokan" :value="__('Patokan')"/>
                                <x-text-input id="patokan" name="patokan" type="text" class="mt-1 block w-full"
                                              :value="old('patokan')"/>
                                <x-input-error class="mt-2" :messages="$errors->get('patokan')"/>
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

        map.locate({setView: true, maxZoom: 18});

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

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Tempat Acara")
                .openOn(map);
            document.getElementById("latitude").value = e.latlng.lat
            document.getElementById("longitude").value = e.latlng.lng
            document.getElementById("accuracy").value = 100 // set accuracy to 100 meters
        }

        map.on('click', onMapClick);
    </script>
</x-app-layout>
