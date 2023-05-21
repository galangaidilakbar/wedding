<section>
    <header>
        <h6 class="text-lg font-bold dark:text-white">
            {{ __('Kelola Pesanan') }}
        </h6>
    </header>

    <div class="grid grid-cols-1 mt-6 space-y-6">
        <!-- Update status pesanan -->
        <form action="{{ route('admin.order.updateStatus', $order) }}" method="post"
              onchange="this.closest('form').submit()">
            @csrf

            @method('patch')

            <div>
                <x-input-label for="status" :value="__('Perbarui status pesanan')"/>

                <x-select name="status" id="status" class="mt-1 block w-full">
                    <option value="" disabled>-- Status --</option>
                    @foreach (App\Models\Order::ORDER_STATUS as $value)
                        <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </x-select>

                <x-input-error :messages="$errors->get('status')" class="mt-2"/>
            </div>
        </form>

        <!-- Trigger dialog upload bukti bayar secara tunai -->
        @if ($order->metode_pembayaran === 'CASH')
            <div class="flex justify-start">
                <x-primary-button id="triggerUploadPaymentDialog">
                    {{ __('Unggah bukti bayar (tunai)') }}
                </x-primary-button>
            </div>
        @endif

        <!-- trigger dialog progress pengerjaan -->
        <div class="flex justify-start">
            <x-primary-button id="triggerProgressPengerjaanDialog">
                {{ __('Tambahkan progress pengerjaan') }}
            </x-primary-button>
        </div>

        <!-- Delete order -->
        <form action="{{ route('order.destroy', $order) }}" method="post"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
            @csrf

            @method('delete')

            <div class="flex justify-start">
                <x-danger-button type="submit">
                    {{ __('Hapus pesanan') }}
                </x-danger-button>
            </div>
        </form>
    </div>

    <!-- Modal upload bukti bayar secara tunai -->
    <dialog class="w-full max-w-xl rounded dark:bg-gray-900" id="modal_upload_bukti_bayar_tunai">
        <form
            action="{{ route('admin.order.payments.store', $order) }}"
            method="post"
            enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <div>
                <x-input-label for="proof_of_payment" :value="__('Unggah bukti bayar')"/>

                <input type="file" name="proof_of_payment" id="proof_of_payment"
                       class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-400 file:text-indigo-700 dark:file:text-indigo-100
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500">

                <x-input-error :messages="$errors->get('proof_of_payment')" class="mt-2"/>

                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    <p>
                        {{ __('Format file yang diterima: jpg, jpeg, png, bmp, gif, svg, or webp. Maksimal ukuran file: 2 MB.') }}
                    </p>
                    <p class="font-bold">
                        {{ __('Pastikan bukti bayar yang diunggah sesuai dengan jumlah yang harus dibayar.') }}
                    </p>
                </div>
            </div>

            <div>
                <x-input-label for="status" :value="__('Tentukan status pesanan')"/>

                <x-select name="status" id="status" class="mt-1 block w-full">
                    <option value="" disabled>-- Status --</option>
                    <option value="{{ App\Models\Order::ORDER_STATUS['WAITING_FOR_REMAINING_PAYMENT'] }}">
                        {{ App\Models\Order::ORDER_STATUS['WAITING_FOR_REMAINING_PAYMENT'] }}
                    </option>
                    <option value="{{ App\Models\Order::ORDER_STATUS['HAS_BEEN_PAID'] }}">
                        {{ App\Models\Order::ORDER_STATUS['HAS_BEEN_PAID'] }}
                    </option>
                </x-select>

                <x-input-error :messages="$errors->get('status')" class="mt-2"/>
            </div>

            <div class="flex justify-end space-x-2">
                <x-secondary-button id="closeUploadPaymentDialog">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('Simpan') }}
                </x-primary-button>
            </div>
        </form>
    </dialog>

    <!-- Modal progress pengerjaan -->
    <dialog class="w-full max-w-xl rounded dark:bg-gray-900" id="modal_progress_pengerjaan">
        <form
            action="{{ route('admin.order.progress.store', $order) }}"
            method="post"
            enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <!-- Textarea -->
            <div>
                <x-input-label for="description" :value="__('Tambahkan progress pengerjaan')"/>

                <x-textarea
                    name="description"
                    id="description"
                    value="{{ old('description') }}"
                    class="block mt-1 w-full"></x-textarea>

                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>

            <!-- Photo -->
            <div>
                <x-input-label for="image" :value="__('Unggah foto')"/>

                <input type="file" name="image" id="image"
                       class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-400 file:text-indigo-700 dark:file:text-indigo-100
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500">

                <x-input-error :messages="$errors->get('image')" class="mt-2"/>

                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    <p>
                        {{ __('Format file yang diterima: jpg, jpeg, png, bmp, gif, svg, or webp. Maksimal ukuran file: 2 MB.') }}
                    </p>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2">
                <x-secondary-button id="closeProgressPengerjaanDialog">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('Tambahkan') }}
                </x-primary-button>
            </div>
        </form>
    </dialog>

    <script>
        const dialog = document.getElementById("modal_upload_bukti_bayar_tunai");
        const button = document.getElementById('triggerUploadPaymentDialog');
        const closeButton = document.getElementById('closeUploadPaymentDialog');

        button.addEventListener('click', () => {
            dialog.showModal();
        });

        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) {
                dialog.close();
            }
        });

        closeButton.addEventListener('click', () => {
            dialog.close();
        });

        // progress pengerjaan
        const dialogProgressPengerjaan = document.getElementById("modal_progress_pengerjaan");
        const buttonProgressPengerjaan = document.getElementById('triggerProgressPengerjaanDialog');
        const closeButtonProgressPengerjaan = document.getElementById('closeProgressPengerjaanDialog');

        buttonProgressPengerjaan.addEventListener('click', () => {
            dialogProgressPengerjaan.showModal();
        });

        dialogProgressPengerjaan.addEventListener('click', (event) => {
            if (event.target === dialogProgressPengerjaan) {
                dialogProgressPengerjaan.close();
            }
        });

        closeButtonProgressPengerjaan.addEventListener('click', () => {
            dialogProgressPengerjaan.close();
        });
    </script>
</section>
