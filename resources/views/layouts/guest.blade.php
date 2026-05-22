<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0000FF]/10 relative overflow-hidden">
            <img src="{{ asset('images/PATTERN1.png') }}" alt="Top Right" class="absolute top-4 right-4 w-96 h-auto -mr-48 -mt-48">

            <img src="{{ asset('images/PATTERN1.png') }}" alt="Bottom Left" class="absolute bottom-0 left-4 w-96 h-auto -ml-48 -mb-44">

            <div>
                <a href="/">
                    <img src="{{ asset('images/logo-bgn.png') }}" alt="Logo MBG" class="h-48 w-auto"/>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        
    </body>
</html>
