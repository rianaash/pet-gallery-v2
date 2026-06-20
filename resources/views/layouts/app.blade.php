<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Whiskr') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=be-vietnam-pro:400,700" rel="stylesheet" />

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    
    <body class="font-sans antialiased bg-[#fffbf7] text-stone-600">
        
    <div class="min-h-screen">
        <livewire:layout.navigation />

        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts

<script>
    // Cek apakah ada pesan dari PHP (Session Flash)
    @if(session('message'))
        Swal.fire({
            icon: 'success', // Icon checklist hijau
            title: 'Berhasil!',
            text: "{{ session('message') }}", // Pesan dari PHP
            confirmButtonColor: '#f43f5e', // Warna Rose-500 biar senada
            confirmButtonText: 'Oke, Siip! 👍',
            background: '#fffbf7', // Warna background krem whiskr
            color: '#44403c', // Warna teks stone-700
            customClass: {
                popup: 'rounded-[2rem] border-2 border-stone-100 shadow-xl'
            }
        });
    @endif
</script>
</body>
</html>