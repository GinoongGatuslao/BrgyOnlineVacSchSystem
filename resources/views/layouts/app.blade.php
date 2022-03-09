<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BOVSS') }}</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>

</head>

<body class="h-full">
    <div class="min-h-full">
        <div class="pb-32 bg-indigo-600">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="py-5">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-white">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        </div>

        <!-- Page Content -->
        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto max-w-screen w-screen-80 sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                {{$slot}}
                <!-- /End replace -->
            </div>
        </main>

    </div>
    @livewireScripts
</body>

</html>
