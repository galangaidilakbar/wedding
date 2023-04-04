<section>
    <header class="flex items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex-1">
            {{ __('Alamat Acara') }}
        </h2>

        <x-primary-button-link href="{{ route('address.create') }}">
            {{ __('Tambah Alamat Baru') }}
        </x-primary-button-link>
    </header>

    @if (session('address-status'))
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 dark:text-gray-400"
        >{{ session('address-status') }}</p>
    @endif

    @forelse($addresses as $address)
        <div class="flex flex-wrap px-6 py-4 rounded-lg dark:bg-gray-900 first:mt-0 mt-4 text-gray-600 dark:text-gray-400">
            <div class="grow flex space-x-4">
                <div class="text-gray-900 dark:text-white font-bold">{{ $address->full_name }}</div>
                <div>{{ $address->phone_number }}</div>
            </div>
            <div class="flex space-x-2">
                <x-primary-link href="{{ route('address.edit', $address) }}">
                    {{ __('translations.Change') }}
                </x-primary-link>

                <form method="POST" action="{{ route('address.destroy', $address) }}">
                    @csrf
                    @method('delete')
                    <x-primary-link href="{{ route('address.destroy', $address) }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('translations.Delete') }}
                    </x-primary-link>
                </form>
            </div>
            <div class="mt-4 w-full block">
                {{ $address->detail }} ({{ $address->patokan }})
            </div>
        </div>
    @empty
        <figure class="flex flex-col justify-center items-center">
            <img src="{{ asset('img/empty.svg') }}" alt="empty illustration" class="w-20 h-auto">
            <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">Data alamat masih kosong</figcaption>
        </figure>
    @endforelse
</section>
