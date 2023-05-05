<section>
    <header>
        <h6 class="text-lg font-bold dark:text-white">
            {{ __('Kelola Pesanan') }}
        </h6>
    </header>

    <div class="grid grid-cols-1 mt-6 space-y-3">
        <!-- Update status pesanan -->
        <form action="{{ route('admin.order.updateStatus', $order) }}"
              method="post"
              onchange="this.closest('form').submit()">
            @csrf

            @method('patch')

            <div>
                <x-input-label for="status" :value="__('Perbarui status pesanan')"/>

                <x-select name="status" id="status" class="mt-1 block w-full">
                    <option value="" disabled>-- Status --</option>
                    @foreach(App\Models\Order::ORDER_STATUS as $value)
                        <option
                            value="{{ $value }}"
                            {{ $order->status === $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </x-select>

                <x-input-error :messages="$errors->get('status')" class="mt-2"/>
            </div>
        </form>
    </div>
</section>
