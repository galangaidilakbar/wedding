<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Search bar -->
                    <div class="mb-4">
                        <x-search-bar to="{{ route('admin.users') }}" placeholder="Cari nama atau email..."/>
                    </div>

                    <!-- Table Users -->
                    <section>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Daftar
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Terakhir Login
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        IP Address
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $key => $user)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $users->firstItem() + $key }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : '-'}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->last_login_ip ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td colspan="5" class="px-6 py-4">
                                            <figure class="flex flex-col justify-center items-center">
                                                <img src="{{ asset('img/empty.svg') }}" alt="empty illustration"
                                                     class="w-20 h-auto">
                                                <figcaption class="mt-4 text-gray-500 dark:text-gray-400 text-sm">
                                                    {{ __('Tidak ada Pengguna') }}
                                                </figcaption>
                                            </figure>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
