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
                <x-input-label for="status" :value="__('Perbarui status pesanan')" />

                <x-select name="status" id="status" class="mt-1 block w-full">
                    <option value="" disabled>-- Status --</option>
                    @foreach (App\Models\Order::ORDER_STATUS as $value)
                        <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </x-select>

                <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
    </div>

    <!-- Modal upload bukti bayar -->
    <dialog class="w-full max-w-xl rounded">
        <form action="{{ route('admin.order.payments.store', $order) }}" method="post" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <div>
                <x-input-label for="proof_of_payment" :value="__('Unggah bukti bayar')" />

                <input type="file" name="proof_of_payment" id="proof_of_payment"
                    class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-400 file:text-indigo-700 dark:file:text-indigo-100
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500">

                <x-input-error :messages="$errors->get('proof_of_payment')" class="mt-2" />

                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    <p>
                        {{ __('Format file yang diterima: jpg, jpeg, png, pdf. Maksimal ukuran file: 2 MB.') }}
                    </p>
                    <p class="font-bold">
                        {{ __('Pastikan bukti bayar yang diunggah sesuai dengan jumlah yang harus dibayar.') }}
                    </p>
                </div>
            </div>

            <div>
                <x-input-label for="status" :value="__('Tentukan status pesanan')" />

                <x-select name="status" id="status" class="mt-1 block w-full">
                    <option value="" disabled>-- Status --</option>
                    <option value="Menunggu Pembayaran Sisa">Menunggu Pembayaran Sisa</option>
                    <option value="Pembayaran Selesai">Pembayaran Selesai</option>
                </x-select>

                <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
</section>

<script>
    const dialog = document.querySelector('dialog');
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
</script>
