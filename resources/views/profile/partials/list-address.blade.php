<section>
    <header class="flex items-center">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex-1">
            {{ __('Alamat Saya') }}
        </h2>

        <x-primary-button-link href="{{ route('address.create') }}">
            Tambah Alamat Baru
        </x-primary-button-link>
    </header>

    <div class="flex flex-col mt-6">
        @forelse($addresses as $address)
            <div class="flex mt-4">
                <div class="flex-1 space-x-2">
                    <strong class="text-gray-900 dark:text-white">{{ $address->full_name }}</strong>
                    <span class="border-l"></span>
                    <span class="text-gray-600 dark:text-gray-400 text-sm">{{ $address->phone_number }}</span>
                </div>
                <div class="flex space-x-2">
                    <x-primary-link href="{{ route('address.edit', $address) }}">
                        Ubah
                    </x-primary-link>

                    <form method="POST" action="{{ route('address.destroy', $address) }}">
                        @csrf
                        @method('delete')
                        <x-primary-link href="{{ route('address.destroy', $address) }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                            Hapus
                        </x-primary-link>
                    </form>
                </div>
            </div>
            <div class="flex mt-4">
                <div class="flex-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $address->detail }} ({{ $address->patokan }})
                </div>
            </div>

            <div class="w-full border-b mt-4"></div>
        @empty
            <figure class="flex flex-col justify-center items-center">
                <img src="{{ asset('img/empty.svg') }}" alt="empty illustration" class="w-20 h-auto">
                <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">Data alamat masih kosong</figcaption>
            </figure>
        @endforelse
    </div>

    <!-- Menampilkan Toast -->
    @if(session('address-status'))
        <div
            class="absolute flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow right-5 bottom-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
            role="alert"
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)">
            <div class="text-sm text-gray-600 dark:text-gray-400">{{ session('address-status') }}</div>
        </div>
    @endif
</section>
