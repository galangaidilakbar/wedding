<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- LeafletJS Map -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
              integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
              crossorigin=""/>

        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
                crossorigin=""></script>

        <link rel="shortcut icon" href="{{ asset('img/ginasty-logo.jpeg') }}" type="image/x-icon">
    </head>
    <body class="font-sans antialiased">
        @include('layouts.bottom-navigation')

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 mb-10 lg:mb-0">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <dialog id="modal-image" class="rounded backdrop-blur-sm bg-white/30 dark:bg-black/30 max-w-xl lg:max-w-4xl">
            <img class="h-auto max-w-full rounded-lg"
                 src="" alt="" id="image-container">
            <!-- close button -->
            <button id="close-modal-image"
                    class="absolute right-0 top-0 p-3 m-3 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 focus:outline-none focus:ring-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </dialog>

        <script>
            const modalImage = document.getElementById('modal-image');
            const imageContainer = document.getElementById('image-container');
            const closeImage = document.getElementById('close-modal-image');

            function openModalImage(url) {
                imageContainer.src = url;
                modalImage.showModal();
            }

            closeImage.addEventListener('click', () => {
                modalImage.close();
            });

            modalImage.addEventListener('click', (event) => {
                if (event.target === modalImage) {
                    modalImage.close();
                }
            });
        </script>
    </body>
</html>
