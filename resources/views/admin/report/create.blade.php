<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-xl">

                        {{-- Alert kalau pesanan tidak ditemukan --}}
                        @if(session('error'))
                            <div
                                class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Alert kalau laporan berhasil dibuat --}}
                        @if(session('success'))
                            <div
                                class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.order.reports.store') }}" method="post" class="space-y-6">
                            @csrf

                            {{-- Pilih tanggal awal --}}
                            <div>
                                <x-input-label for="start_date" :value="__('Pilih Tanggal Awal')"/>
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                              :value="old('start_date')"
                                              required autofocus/>
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                            </div>

                            {{-- Pilih tanggal akhir --}}
                            <div>
                                <x-input-label for="end_date" :value="__('Pilih Tanggal Akhir')"/>
                                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                              :value="old('end_date')"
                                              required/>
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2"/>
                            </div>

                            {{-- Download button --}}
                            <x-primary-button class="w-full inline-flex justify-center space-x-2">
                                <span>{{ __('Download') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5">
                                    <path
                                        d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z"/>
                                    <path
                                        d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z"/>
                                </svg>
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
