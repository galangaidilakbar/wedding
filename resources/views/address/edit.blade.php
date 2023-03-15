<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ubah Alamat') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Mohon diperhatikan bahwa alamat ini akan dijadikan sebagai lokasi acara pernikahan.") }}
                            </p>
                        </header>

                        <section class="mt-6">
                            <div id="map" class="h-80"></div>
                        </section>

                        <form method="post" action="{{ route('address.update', $address) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="accuracy" name="accuracy">

                            <div class="grid grid-cols-2 space-x-4">
                                <!-- Nama Lengkap -->
                                <div>
                                    <x-input-label for="full_name" :value="__('Nama Lengkap')"/>
                                    <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full"
                                                  :value="old('full_name', $address->full_name)" required autofocus
                                                  autocomplete="name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('full_name')"/>
                                </div>

                                <!-- Nomor telepon -->
                                <div>
                                    <x-input-label for="phone_number" :value="__('Nomor Telepon')"/>
                                    <x-text-input id="phone_number" name="phone_number" type="number"
                                                  class="mt-1 block w-full"
                                                  :value="old('phone_number', $address->phone_number)" required/>
                                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')"/>
                                </div>
                            </div>

                            <!-- Detail alamat -->
                            <div>
                                <x-input-label for="detail" :value="__('Detail Alamat')"/>
                                <textarea id="detail" name="detail" rows="4"
                                          class="block p-2.5 w-full mt-1 text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                          placeholder="Leave a comment...">{{ old('detail', $address->detail) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('detail')"/>
                            </div>

                            <!-- Patokan -->
                            <div>
                                <x-input-label for="patokan" :value="__('Patokan')"/>
                                <x-text-input id="patokan" name="patokan" type="text" class="mt-1 block w-full"
                                              :value="old('patokan', $address->patokan)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('patokan')"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Ubah') }}</x-primary-button>
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

        map.locate({setView: true, maxZoom: 19});

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
