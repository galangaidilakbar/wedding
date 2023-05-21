<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Order detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Alerts, summary, and others -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Alert Menunggu Pembayaran -->
                    @if ($order->status === 'Menunggu Pembayaran')
                        <div
                            class="p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                            role="alert">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Info</span>
                                <h3 class="text-lg font-medium">{{ $order->status }}</h3>
                            </div>

                            <div class="mt-2 mb-4 text-sm">
                                Saat ini, kami sedang menunggu pembayaran dari Anda. Mohon segera melakukan
                                pembayaran agar pesanan Anda dapat segera dikerjakan. Terima kasih.
                            </div>

                            <div class="flex">
                                <!-- Lakukan Pembayaran jika metode pembayaran adalah BANK -->
                                @if ($order->metode_pembayaran === 'BANK')
                                    <a href="{{ route('order.payments.create', $order) }}"
                                       class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800">
                                        {{ __('Lakukan Pembayaran') }}
                                    </a>
                                @endif

                                <!-- Batalkan Pesanan jika status Menunggu Pembayaran -->
                                @if ($order->status === 'Menunggu Pembayaran')
                                    <div x-data="{open: false}">
                                        <button type="submit"
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-cancel-order')"
                                                class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-yellow-300 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-gray-800 dark:focus:ring-yellow-800">
                                            {{ __('Batalkan Pesanan') }}
                                        </button>

                                        <!-- Modal to cancel an order -->
                                        <x-modal name="confirm-cancel-order" focusable>
                                            <form method="post" action="{{ route('order.cancel', $order) }}"
                                                  class="p-6">
                                                @csrf
                                                @method('patch')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Apakah Anda yakin ingin membatalkan pesanan ini?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Harap dicatat bahwa tanggal yang Anda pilih mungkin telah diambil oleh orang lain setelah pesanan Anda dibuat. Mohon beritahu kami alasan Anda membatalkan pesanan ini.') }}
                                                </p>

                                                <div class="mt-6">
                                                    <x-input-label for="description" value="description"
                                                                   class="sr-only"/>

                                                    <x-select
                                                        id="description"
                                                        name="description"
                                                        class="mt-1 block w-full lg:w-3/4"
                                                        required>
                                                        <option value="" disabled>-- Pilih alasan --</option>
                                                        <option value="perubahan rencana">Perubahan Rencana</option>
                                                        <option value="masalah kesehatan">Masalah Kesehatan</option>
                                                        <option value="kendala keuangan">Kendala Keuangan</option>
                                                        <option value="perubahan prioritas">Perubahan Prioritas</option>
                                                        <option value="pembatalan venue">Pembatalan Venue</option>
                                                        <option value="pengantin meninggal">Pengantin Meninggal</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </x-select>

                                                    <x-input-error :messages="$errors->get('description')"
                                                                   class="mt-2"/>
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('translations.Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ml-3">
                                                        {{ __('Konfimasi') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Alert Pesanan Dibatalkan -->
                    @if(session('order-status') === 'order-canceled')
                        <div
                            x-data="{ open: true }"
                            x-show="open"
                            x-transition
                            x-init="setTimeout(() => open = false, 5000)"
                            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            {{ __('Pesanan berhasil dibatalkan.') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 space-y-6" x-data="{ open: false, progress: false }">
                        <!-- Qr code -->
                        <div class="flex justify-center flex-col">
                            <img
                                src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('order.show', $order) }}"
                                alt="the qr code for this order"
                                class="h-40 w-40 mx-auto rounded">
                            <div class="mt-2">
                                <p class="text-gray-500 dark:text-gray-400 text-xs text-center">
                                    {{ __('Tunjukkan QR Code ini kepada Admin untuk melakukan pembayaran.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="flex justify-between items-center">
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ $order->status }}
                            </h6>

                            <button @click="open = !open"
                                    class="text-right font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    x-text="open ? '{{ __('Tutup') }}' : '{{ __('Lihat Detail') }}'">
                            </button>
                        </div>

                        <!-- Timeline status pesanan -->
                        <ol x-show="open" x-transition class="relative border-l border-gray-200 dark:border-gray-700">
                            @foreach ($order->timelines()->latest()->get() as $timeline)
                                <li class="mb-10 ml-4">
                                    <div
                                        class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                    </div>
                                    <time
                                        class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                        {{ $timeline->created_at->format('d F Y, H:i') }}
                                    </time>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $timeline->title }}
                                    </h3>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        {{ $timeline->description }}
                                    </p>
                                </li>
                            @endforeach
                        </ol>

                        <div class="border-b dark:border-gray-400 border-dashed"></div>

                        <!-- Order id -->
                        <div class="flex justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('No. Pesanan') }}
                            </div>
                            <div class="text-gray-900 dark:text-gray-400 text-sm">
                                {{ $order->id }}
                            </div>
                        </div>

                        <!-- Invoice -->
                        <div class="flex justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('translations.Invoice') }}
                            </div>
                            <div class="text-gray-900 text-sm">
                                <x-primary-link href="{{ route('order.invoice', $order) }}">
                                    {{ __('Download') }}
                                </x-primary-link>
                            </div>
                        </div>

                        <!-- Tanggal Pesanan -->
                        <div class="flex justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('translations.Order date') }}
                            </div>
                            <div class="text-gray-900 dark:text-gray-100 text-sm">
                                {{ $order->created_at->format('d F Y, H:i') }}
                            </div>
                        </div>

                        <!-- Tanggal Acara -->
                        <div class="flex justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('translations.Event date') }}
                            </div>
                            <div class="text-gray-900 dark:text-gray-100 text-sm">
                                {{ $order->tanggal_acara->format('d F Y') }}
                            </div>
                        </div>

                        <div class="border-b dark:border-gray-400 border-dashed"></div>

                        <!-- Progress Acara -->
                        <div class="flex justify-between items-center">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                Progress Acara
                            </div>
                            <button @click="progress = !progress"
                                    class="text-right font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    x-text="progress ? '{{ __('Tutup') }}' : '{{ __('Lihat Detail') }}'">
                            </button>
                        </div>

                        <!-- Progress Acara -->
                        <ol x-show="progress" x-transition
                            class="relative border-l border-gray-200 dark:border-gray-700">
                            @forelse ($order->progresses()->latest()->get() as $progress)
                                <li class="mb-10 ml-4">
                                    <div
                                        class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                    </div>
                                    <time
                                        class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                        {{ $progress->created_at->format('d F Y, H:i') }}
                                    </time>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        {{ $progress->description }}
                                    </p>
                                    <img
                                        src="{{ $progress->image_url }}"
                                        alt="{{ $progress->description }}"
                                        class="w-32 rounded mt-4"
                                        onclick="openModalImage(this.src)">
                                </li>
                            @empty
                                <div class="text-sm text-gray-500 dark:text-gray-400 text-center">
                                    belum ada progress...
                                </div>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Detail Produk') }}
                            </h6>
                        </header>

                        <div class="grid grid-cols-1 mt-6">
                            @foreach ($order->detail_orders as $cart)
                                <div class="flex space-x-8 mt-4 first:mt-0">
                                    <div class="w-32">
                                        <img src="{{ $cart->product->photo_url }}" alt="{{ $cart->product->name }}"
                                             class="rounded" loading="lazy" onclick="openModalImage(this.src)">
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ $cart->product->name }}
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400 text-sm lg:hidden">
                                            Rp @rupiah($cart->product->price)
                                        </div>
                                    </div>
                                    <div class="text-gray-700 dark:text-gray-400 hidden lg:block">
                                        Rp @rupiah($cart->product->price)
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-b dark:border-gray-400 border-dashed mt-6"></div>

                        <!-- Catatan -->
                        <div class="grid grid-cols-1 gap-4 mt-6">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ __('Catatan: ') }}
                            </div>
                            <div class="text-gray-900 dark:text-gray-100 text-sm">
                                {{ $order->catatan ?? '-' }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Alamat Acara -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Alamat Acara') }}
                            </h6>
                        </header>

                        <div class="mt-6">
                            <!-- Map Container -->
                            <div id="map" class="h-96 bg-gray-300 rounded dark:bg-gray-700"></div>

                            <!-- Nama Lengkap -->
                            <div class="font-bold mb-1 text-gray-900 dark:text-gray-100 mt-4">
                                {{ $order->address->full_name }}
                            </div>

                            <!-- Nomor telepon -->
                            <div class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ $order->address->phone_number }}
                            </div>

                            <!-- Detail alamat -->
                            <div class="text-gray-500 dark:text-gray-400 text-xs lg:text-sm mt-2">
                                {{ $order->address->detail }} ({{ $order->address->patokan }})
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Rincian Pembayaran -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Rincian Pembayaran') }}
                            </h6>
                        </header>

                        <div class="grid grid-cols-1 mt-6 space-y-3">
                            <!-- Opsi Bayar -->
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Opsi Bayar') }}
                                </div>
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $order->opsi_bayar }}
                                </div>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Metode Pembayaran') }}
                                </div>
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $order->metode_pembayaran }}
                                </div>
                            </div>

                            <!-- Total DP -->
                            @if ($order->opsi_bayar === 'DP')
                                <div class="flex justify-between">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('Total DP') }}
                                    </div>
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        Rp @rupiah($order->total_dp)
                                    </div>
                                </div>
                            @endif

                            <!-- Riwayat Pembayaran -->
                            <div class="grid grid-cols-2" x-data="{ open: false }">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Riwayat Pembayaran') }}
                                </div>
                                <button @click="open = !open"
                                        class="text-right font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        x-text="open ? '{{ __('Tutup') }}' : '{{ __('Lihat Detail') }}'">
                                </button>

                                <!-- Detail Riwayat Pembayaran -->
                                <div x-show="open" x-transition class="col-span-2 mt-6">
                                    @forelse ($order->payments as $payment)
                                        <div class="flex justify-between gap-4 first:mt-0 mt-6">
                                            <!-- Bukti Bayar -->
                                            <div class="w-32">
                                                <img src="{{ $payment->proof_of_payment_url }}"
                                                     alt="{{ $payment->proof_of_payment }}"
                                                     onclick="openModalImage(this.src)"
                                                     class="rounded">
                                            </div>

                                            <div class="grow">
                                                <!-- Status Pembayaran -->
                                                <div class="text-sm text-gray-900 dark:text-gray-100 font-medium">
                                                    {{ $payment->status }}
                                                </div>

                                                <!-- Catatan dari admin -->
                                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                    {{ $payment->note }}
                                                </div>

                                                <!-- Last Update -->
                                                <div class="text-xs italic text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ __('Pembaharuan terakhir: ') }}
                                                    {{ $payment->updated_at->format('d M Y, H:i') }}
                                                </div>

                                                @if(request()->user()->isAdmin())
                                                    <!-- Update status pembayaran -->
                                                    <form
                                                        action="{{ route('admin.order.payments.updateStatus', [$order, $payment]) }}"
                                                        method="post" onchange="this.closest('form').submit()">
                                                        @csrf

                                                        @method('patch')

                                                        <x-select class="mt-2" name="status">
                                                            @foreach (App\Models\Payments::STATUS as $value)
                                                                <option
                                                                    value="{{ $value }}" {{ $payment->status === $value ? 'selected' : '' }}>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </x-select>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <div class="italic text-xs text-center text-gray-900 dark:text-gray-100">
                                            {{ __('Belum ada pembayaran...') }}
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="border-b border-dashed dark:border-gray-400"></div>

                            <!-- Total Belanja -->
                            <div class="flex justify-between">
                                <div class="text-gray-900 dark:text-gray-100 text-sm font-bold">
                                    {{ __('Total Belanja') }}
                                </div>
                                <div class="text-gray-900 dark:text-gray-100 text-sm font-bold">
                                    Rp @rupiah($order->total_harga)
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            @if(request()->user()->isAdmin())
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('admin.order.manage-order')
                    </div>
                </div>
            @endif

            <script>
                const map = L.map('map').setView([{{ $order->address->latitude }}, {{ $order->address->longitude }}], 19);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                L.marker([{{ $order->address->latitude }}, {{ $order->address->longitude }}]).addTo(map)
                    .bindPopup("Tempat Acara {{ $order->address->full_name }}")
                    .openPopup();
            </script>
        </div>
    </div>


</x-app-layout>
