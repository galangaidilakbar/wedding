<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reschedule Acara') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-xl">
                        <div
                            class="grid grid-cols-1 space-y-6 text-sm">
                            <h3 class="text-lg font-medium">
                                Pengajuan Reschedule
                            </h3>

                            <!-- Order id -->
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">
                                    Order ID
                                </div>
                                <div>
                                    {{ $order->id }}
                                </div>
                            </div>

                            <!-- Tanggal Lama -->
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">
                                    Tanggal Lama
                                </div>
                                <div>
                                    {{ $order->tanggal_acara->toFormattedDateString() }}
                                </div>
                            </div>

                            <!-- Tanggal Baru -->
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">
                                    Tanggal Baru
                                </div>
                                <div>
                                    {{ $order->reschedule->new_date->toFormattedDateString() }}
                                </div>
                            </div>

                            <!-- Alasan -->
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">
                                    Alasan
                                </div>
                                <div>
                                    {{ $order->reschedule->reason }}
                                </div>
                            </div>

                            <!-- Status Pengajuan -->
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">
                                    Status Pengajuan Reschedule
                                </div>
                                <div>
                                    {{ $order->reschedule->status }}
                                </div>
                            </div>

                            <!-- Admin -->
                            @if(request()->user()->isAdmin())
                                <form action="{{ route('admin.order.reschedule.update', [$order, $reschedule]) }}"
                                      method="post">
                                    @csrf

                                    @method('PUT')

                                    <div class="flex justify-end space-x-4">
                                        <x-danger-button name="status"
                                                         value="{{ App\Models\Reschedule::STATUS['REJECTED'] }}">
                                            {{ __('Tolak') }}
                                        </x-danger-button>

                                        <x-primary-button name="status"
                                                          value="{{ App\Models\Reschedule::STATUS['APPROVED'] }}">
                                            {{ __('Terima') }}
                                        </x-primary-button>
                                    </div>
                                </form>

                                <form action="{{ route('admin.order.reschedule.destroy', [$order, $reschedule]) }}"
                                      method="post">
                                    @csrf

                                    @method('DELETE')

                                    <div class="flex justify-end">
                                        <x-danger-button>
                                            {{ __('Hapus') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
