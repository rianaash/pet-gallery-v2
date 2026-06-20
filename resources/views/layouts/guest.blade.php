<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Whiskr') }}</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=be-vietnam-pro:400,700" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">

        <style>
        .brand-font { font-family: 'Fredoka', sans-serif; }
    </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans text-stone-600 bg-[#fffbf7]">
        <div class="absolute top-20 right-0 w-64 h-64 bg-yellow-200 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-20 left-10 w-48 h-48 bg-rose-300 rounded-full blur-3xl opacity-60"></div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
             <div class="mb-6">
                 <a href="/" class="flex items-center gap-2 group" wire:navigate>
                    <div class="w-12 h-12 bg-orange-300 text-white rounded-2xl flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rabbit-icon lucide-rabbit"><path d="M13 16a3 3 0 0 1 2.24 5"/><path d="M18 12h.01"/><path d="M18 21h-8a4 4 0 0 1-4-4 7 7 0 0 1 7-7h.2L9.6 6.4a1 1 0 1 1 2.8-2.8L15.8 7h.2c3.3 0 6 2.7 6 6v1a2 2 0 0 1-2 2h-1a3 3 0 0 0-3 3"/><path d="M20 8.54V4a2 2 0 1 0-4 0v3"/><path d="M7.612 12.524a3 3 0 1 0-1.6 4.3"/></svg>
                    </div>
                    <span class="font-bold text-3xl tracking-tight text-stone-700">Whiskr.</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-[0_10px_40px_rgba(0,0,0,0.05)] rounded-[2rem] border border-orange-100/50">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts
    </body>
</html>