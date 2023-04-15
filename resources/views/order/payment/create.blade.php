<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('translations.Upload Proof of Payment Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Panduan Pembayaran -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h6 class="text-lg font-bold dark:text-white">
                                {{ __('Panduan Pembayaran') }}
                            </h6>
                        </header>

                        <div class="mt-6 grid grid-cols-1 space-y-8">
                            <!-- Informasi Rekening -->
                            <ul class="list-disc list-inside space-y-2 text-sm text-gray-900 dark:text-gray-100">
                                <li><strong>Kode bank BRI</strong> adalah <strong>002</strong>.</li>
                                <li><strong>Nomor rekening {{ config('app.name') }}</strong> adalah
                                    <strong>123456789012345</strong>.
                                </li>
                                <li><strong>Nama rekening</strong> adalah
                                    <strong>{{ config('invoices.seller.attributes.name') }}</strong>.
                                </li>
                            </ul>

                            <!-- Petunjuk Transfer MBanking -->
                            <div x-data="{ open: false }" class="grid grid-cols-2">

                                <div class="col-span-2 flex justify-between">
                                    <!-- Judul -->
                                    <div class="text-gray-900 font-medium dark:text-gray-100">
                                        {{ __('Petunjuk Transfer MBanking') }}
                                    </div>

                                    <!-- Toggle -->
                                    <button @click="open = !open" class="text-gray-900 dark:text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path :class="{ 'hidden': open, 'inline-flex': !open }"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            <path :class="{ 'hidden': !open, 'inline-flex': !open }"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Konten -->
                                <div class="col-span-2 mt-3 text-gray-600 dark:text-gray-400 text-sm" x-show="open"
                                    x-transition>
                                    <p>Berikut adalah langkah-langkah pembayaran melalui Mobile Banking BRI:</p>

                                    <ol class="list-decimal list-inside space-y-2 mt-4">
                                        <li>Login ke aplikasi mobile banking BRI atau internet banking BRI.</li>
                                        <li>Pilih menu "Transfer".</li>
                                        <li>Pilih jenis transfer "Antar Rekening BRI".</li>
                                        <li>Masukkan nomor rekening <strong>123456789012345</strong>.</li>
                                        <li>Masukkan nominal pembayaran sebesar <strong>Rp @rupiah($order->total_harga)</strong>.
                                        </li>
                                        <li>Periksa kembali informasi yang telah dimasukkan, pastikan semuanya benar.
                                        </li>
                                        <li>Jika informasi yang dimasukkan benar, tekan "Ya" atau "OK" untuk
                                            menyelesaikan transaksi.</li>
                                        <li>Anda akan diminta untuk memasukkan PIN transaksi untuk mengkonfirmasi
                                            transaksi.</li>
                                        <li>Setelah transaksi selesai, Anda akan menerima notifikasi atau SMS dari bank
                                            BRI sebagai bukti pembayaran.</li>
                                    </ol>
                                </div>
                            </div>

                            <!-- Petunjuk Transfer ATM -->
                            <div x-data="{ open: false }" class="grid grid-cols-2">
                                <div class="col-span-2 flex justify-between">
                                    <!-- Judul -->
                                    <div class="text-gray-900 dark:text-gray-100 font-medium">
                                        {{ __('Petunjuk Transfer ATM') }}
                                    </div>

                                    <!-- Toggle -->
                                    <button @click="open = !open" class="text-gray-900 dark:text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path :class="{ 'hidden': open, 'inline-flex': !open }"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            <path :class="{ 'hidden': !open, 'inline-flex': !open }"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Konten -->
                                <div class="col-span-2 mt-3 text-gray-600 dark:text-gray-400 text-sm" x-show="open"
                                    x-transition>
                                    <p>Berikut adalah langkah-langkah tutorial pembayaran melalui ATM: </p>

                                    <ol class="list-decimal list-inside space-y-2 mt-4">
                                        <li>Kunjungi kantor cabang BRI terdekat atau ATM BRI.</li>
                                        <li>Pilih menu "Transfer" pada layar ATM.</li>
                                        <li>Pilih jenis transfer "Antar Bank" atau "Transfer ke Bank Lain".</li>
                                        <li>Masukkan kode bank BRI, yaitu <strong>"002"</strong></li>
                                        <li>Masukkan nomor rekening <strong>123456789012345</strong>.</li>
                                        <li>Masukkan nominal pembayaran sebesar <strong>Rp @rupiah($order->total_harga)</strong>.
                                        </li>
                                        <li>Periksa kembali informasi yang telah dimasukkan, pastikan semuanya benar.
                                        </li>
                                        <li>Jika informasi yang dimasukkan benar, tekan "Ya" atau "OK" untuk
                                            menyelesaikan transaksi.</li>
                                        <li>Ambil bukti transfer atau struk ATM sebagai bukti pembayaran.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Form Upload Bukti bayar -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="{{ route('order.payments.store', $order) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Proof of payment -->
                        <div>
                            <x-input-label for="proof_of_payment" :value="__('translations.Upload Proof of Payment Form')" />
                            <input type="file" name="proof_of_payment" id="proof_of_payment"
                                class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-400 file:text-indigo-700 dark:file:text-indigo-100
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500"
                                accept=".jpeg, .png, .jpg, .svg">
                            <x-input-error class="mt-2" :messages="$errors->get('proof_of_payment')" />
                        </div>

                        <x-primary-button class="mt-4">
                            {{ __('translations.Upload') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
