<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Whiskr') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net"><link href="https://fonts.bunny.net/css?family=balsamiq-sans:400|be-vietnam-pro:400|capriola:400" rel="stylesheet" /><link href="https://fonts.bunny.net/css?family=quicksand:400,500,600,700|fredoka:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        h1, h2, h3, h4, .brand-font { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="font-sans antialiased text-stone-600 bg-[#f6f0ef]">

    <nav x-data="{ open: false }" class="absolute bg-[#f6f0ef]/80 shadow-lg sticky top-0 w-full z-50 left-0 right-0">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        
        {{-- 1. LOGO (Tampil di HP & Laptop) --}}
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-orange-300 text-white rounded-2xl flex items-center justify-center shadow-lg transform -rotate-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="4" r="2"/><circle cx="18" cy="8" r="2"/><circle cx="20" cy="16" r="2"/>
                    <path d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/>
                </svg>
            </div>
            <span class="font-bold text-2xl tracking-tight text-stone-700 brand-font">Whiskr.</span>
        </div>

        {{-- 2. TOMBOL HAMBURGER (Hanya Tampil di HP / Mobile) --}}
        <div class="md:hidden">
            <button @click="open = !open" class="text-stone-600 hover:text-orange-400 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- 3. LINK TENGAH (Hanya Tampil di Laptop / md ke atas) --}}
        <div class="hidden md:flex gap-1">
            <a href="#explore" class="text-stone-600 font-semibold hover:text-orange-300 transition px-4 py-2">Jelajahi</a>
            <a href="#galeri" class="text-stone-600 font-semibold hover:text-orange-300 transition px-4 py-2">Galeri</a>
            <a href="#features" class="text-stone-600 font-semibold hover:text-orange-300 transition px-4 py-2">Fitur</a>
        </div>

        {{-- 4. TOMBOL AUTH (Hanya Tampil di Laptop / md ke atas) --}}
        <div class="hidden md:flex gap-3 items-center">
            <a href="{{ route('login') }}" class="text-stone-500 font-bold hover:text-orange-300 transition px-4">Masuk</a>
            <a href="{{ route('register') }}" class="bg-orange-300 text-white px-6 py-2.5 rounded-full font-bold hover:bg-orange-400 transition shadow-lg hover:shadow-orange-200/50 transform hover:-translate-y-0.5">Daftar Yuk!</a>
        </div>
    </div>

    {{-- 5. MENU MOBILE DROPDOWN (Muncul saat Hamburger diklik) --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="open = false"
         class="md:hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-md shadow-xl border-t border-orange-100 py-4 px-6 flex flex-col gap-4">
        
        {{-- Link Mobile --}}
        <div class="flex flex-col gap-2">
            <a href="#explore" class="text-stone-600 font-semibold hover:text-orange-400 py-2 border-b border-stone-100">Jelajahi</a>
            <a href="#galeri" class="text-stone-600 font-semibold hover:text-orange-400 py-2 border-b border-stone-100">Galeri</a>
            <a href="#features" class="text-stone-600 font-semibold hover:text-orange-400 py-2 border-b border-stone-100">Fitur</a>
        </div>

        {{-- Tombol Mobile --}}
        <div class="flex flex-col gap-3 mt-2">
            <a href="{{ route('login') }}" class="text-center text-stone-500 font-bold hover:text-orange-400 py-2">Masuk</a>
            <a href="{{ route('register') }}" class="text-center bg-orange-300 text-white px-6 py-3 rounded-xl font-bold hover:bg-orange-400 shadow-md">Daftar Yuk!</a>
        </div>
    </div>
</nav>

    <section class="relative bg-orange-50 pt-36 pb-24 overflow-hidden">
        <div class="absolute top-20 right-0 w-64 h-64 bg-yellow-200 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-20 left-10 w-48 h-48 bg-rose-300 rounded-full blur-3xl opacity-60"></div>

        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-6 text-center md:text-left">
                <div class="inline-block px-4 py-2 bg-white rounded-full text-orange-300 text-sm font-bold tracking-wide shadow-sm border border-orange-100 transform -rotate-1">
                     Komunitas Pecinta Hewan #1
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-stone-800 leading-tight">
                    Dunia <span class="text-orange-400 bg-orange-100 px-2 rounded-lg">Ceria</span> untuk <br>
                    <span class="text-rose-400 relative inline-block">
                        Anabulmu
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-rose-300 opacity-60" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="3" fill="none" /></svg>
                    </span>
                </h1>
                <p class="text-lg text-stone-500 font-medium max-w-md mx-auto md:mx-0 leading-relaxed">
                    Bagikan momen lucu, temukan teman bermain, dan simpan kenangan manis hewan kesayanganmu di sini.
                </p>
                <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-rose-400 text-white font-bold rounded-2xl hover:bg-rose-500 transition shadow-xl hover:shadow-rose-300/50 text-center text-lg">
                        Mulai Sekarang ! 
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-2 rounded-[2rem] shadow-xl rotate-[-3deg] hover:rotate-0 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1560114928-40f1f1eb26a0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-[1.5rem] object-cover h-56 w-full">
                    </div>
                    <div class="bg-white p-2 rounded-[2rem] shadow-xl rotate-[3deg] hover:rotate-0 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=500&q=80" class="rounded-[1.5rem] object-cover h-56 w-full">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="explore" class="bg-orange-50 py-16 relative">
        <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-stone-700">Upload Hewan Kesayanganmu disini!</h2>
                <p class="text-stone-600/70 font-medium mt-2">Whiskr menyediakan foto sesuai kategorinya.</p>

                <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mt-5">
                    <div class="bg-orange-300 p-4 rounded-full shadow-md hover:shadow-xl transition duration-300 border border-orange-100 hover:border-orange-300">
                        <h4 class="font-bold text-white text-xl">Kucing</h4>
                    </div>
                    <div class="bg-orange-300 p-4 rounded-full shadow-md hover:shadow-xl transition duration-300 border border-orange-100 hover:border-orange-300">
                        <h4 class="font-bold text-white text-xl">Anjing</h4>
                    </div>
                    <div class="bg-orange-300 p-4 rounded-full shadow-md hover:shadow-xl transition duration-300 border border-orange-100 hover:border-orange-300">
                        <h4 class="font-bold text-white text-xl">Kelinci</h4>
                    </div>
                    <div class="bg-orange-300 p-4 rounded-full shadow-md hover:shadow-xl transition duration-300 border border-orange-100 hover:border-orange-300">
                        <h4 class="font-bold text-white text-xl">Ikan</h4>
                    </div>
                    <div class="bg-orange-300 p-4 rounded-full shadow-md hover:shadow-xl transition duration-300 border border-orange-100 hover:border-orange-300">
                        <h4 class="font-bold text-white text-xl">Hamster</h4>
                    </div>
                    <div class="bg-orange-300 p-4 rounded-full shadow-md hover:shadow-xl transition duration-300 border border-orange-100 hover:border-orange-300">
                        <h4 class="font-bold text-white text-xl">Reptil</h4>
                    </div>
                    
        </div>
    </section>

    <section id="galeri" class="bg-yellow-50 py-24" id="explore">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            
            <div class="relative order-last md:order-first">
                <div class="w-80 h-80 mx-auto rounded-full bg-white p-3 shadow-[0_20px_50px_rgba(252,211,77,0.3)] flex items-center justify-center relative z-10 border-4 border-dashed border-yellow-200">
                    <img src="https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=500&q=80" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="absolute top-4 right-4 w-12 h-12 bg-orange-300 rounded-full animate-bounce"></div>
                <div class="absolute bottom-4 left-4 w-16 h-16 bg-rose-300 rounded-full animate-pulse"></div>
            </div>

            <div class="text-center md:text-right">
                <h2 class="text-4xl font-bold text-stone-700 mb-4">⭐ Momen Anabulmu, Layak Dibagikan</h2>
                <p class="text-stone-500 font-medium mb-6 leading-relaxed text-lg">
                    Simpan foto-foto terbaik anabulmu dengan filter estetik, stiker lucu, dan kualitas HD. Semuanya gratis!
                </p>
                <h2 class="text-4xl font-bold text-stone-700 mb-4">⭐ Abadikan & Bagikan Momen</h2>
                <p class="text-stone-500 font-medium mb-6 leading-relaxed text-lg">
                    Bagikan momen lucu dan menggemaskan hewan peliharaanmu dengan komunitas pecinta hewan lainnya.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-stone-700 border-2 border-stone-100 px-8 py-3 rounded-2xl text-sm font-bold shadow-sm hover:border-orange-300 hover:text-orange-500 transition">
                    Mulai Sekarang!
                </a>
            </div>
        </div>
    </section>

    <section id="features" class="bg-[#f0fdfa] py-20 relative overflow-hidden"> <div class="absolute top-0 left-0 w-full overflow-hidden leading-none rotate-180 transform -translate-y-[1px]">
             <svg class="relative block w-[calc(100%+1.3px)] h-16 text-yellow-50" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="currentColor"></path>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-teal-700">Kenapa Whiskr?</h2>
                <p class="text-teal-600/70 font-medium mt-2">Tempat ternyaman untuk hewan peliharaan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition duration-300 border border-teal-100">
                    <div class="w-20 h-20 mx-auto rounded-full bg-teal-100 text-teal-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h4 class="font-bold text-stone-700 text-lg mb-2">Upload Sat-Set</h4>
                    <p class="text-stone-500 text-sm">Gak pake ribet, langsung pamer foto lucu.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition duration-300 border border-teal-100">
                    <div class="w-20 h-20 mx-auto rounded-full bg-rose-100 text-rose-400 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-stone-700 text-lg mb-2">Banjir Likes</h4>
                    <p class="text-stone-500 text-sm">Dapatkan cinta dari komunitas yang positif.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition duration-300 border border-teal-100">
                    <div class="w-20 h-20 mx-auto rounded-full bg-orange-100 text-orange-400 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-stone-700 text-lg mb-2">Cari Teman</h4>
                    <p class="text-stone-500 text-sm">Kenalan sama pemilik anabul lain di kotamu.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-sky-50 py-24 relative">
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform -translate-y-[98%]">
            <svg class="relative block w-[calc(100%+1.3px)] h-16 text-sky-50" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#f0fdfa"></path>
            </svg>
        </div>

        <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-sky-900 mb-4">Si Kucing Oren <br>Yang Viral! 😼</h2>
                <p class="text-sky-800/70 mb-6 font-medium leading-relaxed">
                    Setiap minggu kami memilih "Pet of the Week". Ayo gabung, siapa tahu anabul kamu yang bakal mejeng di sini minggu depan!
                </p>
                <div class="flex gap-3">
                    <span class="bg-orange-400 text-white px-4 py-2 text-xs font-bold uppercase rounded-xl shadow-sm">Mulai sekarang!</span>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -top-6 -right-6 bg-yellow-400 text-white w-24 h-24 rounded-full flex flex-col items-center justify-center font-bold shadow-lg rotate-12 z-20 animate-bounce-slow border-4 border-white">
                    <span class="text-xs">Minggu</span>
                    <span class="text-2xl leading-none">Ini</span>
                </div>
                
                <div class="bg-white p-4 rounded-[2rem] shadow-xl transform rotate-2 hover:rotate-0 transition duration-500 border border-sky-100">
                    <img src="https://images.unsplash.com/photo-1519052537078-e6302a4968d4?w=500&q=80" class="rounded-[1.5rem] w-full h-80 object-cover">
                    <div class="mt-4 flex items-center gap-3 px-2 pb-2">
                        <div class="w-10 h-10 rounded-full bg-stone-200 overflow-hidden">
                             <img src="https://ui-avatars.com/api/?name=Oyen&background=random" />
                        </div>
                        <div>
                            <p class="font-bold text-sm text-stone-700">Oyen The Cat</p>
                            <p class="text-xs text-stone-400">@oyen_barbar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="bg-[#292019] text-white py-16 relative mt-12">
         <div class="absolute top-0 left-0 w-full overflow-hidden leading-none rotate-180 transform -translate-y-[98%]">
            <svg class="relative block w-[calc(100%+1.3px)] h-12 text-[#4a4440]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="white"></path>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-4 gap-8 text-sm">
            <div class="col-span-1 md:col-span-1">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2 font-fredoka">
                    <div class="w-10 h-10 bg-orange-300 text-white rounded-2xl flex items-center justify-center shadow-lg transform -rotate-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paw-print-icon lucide-paw-print"><circle cx="11" cy="4" r="2"/><circle cx="18" cy="8" r="2"/><circle cx="20" cy="16" r="2"/>
                    <path d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/>
                </svg>
            </div>
                    Whiskr.
                </h2>
                <p class="text-stone-300 leading-relaxed">
                    Dibuat dengan ❤️ untuk para pecinta hewan di seluruh dunia.
                </p>
            </div>

            <div>
                <h4 class="font-bold uppercase mb-4 text-orange-200 tracking-wider">Info</h4>
                <ul class="space-y-2 text-stone-300">
                    <li><a href="https://www.instagram.com/rianashl/?utm_source=ig_web_button_share_sheet" class="hover:text-orange-300 transition">Tentang Kami</a></li>
                    <li><a href="https://www.instagram.com/rianashl/?utm_source=ig_web_button_share_sheet" class="hover:text-orange-300 transition">Bantuan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold uppercase mb-4 text-orange-200 tracking-wider">Newsletter</h4>
                <div class="flex">
                    <input type="email" placeholder="Email kamu" class="bg-stone-600/50 border border-stone-600 text-white px-4 py-2 rounded-l-xl w-full focus:outline-none focus:border-orange-400">
                    <button class="bg-orange-500 px-4 py-2 rounded-r-xl hover:bg-orange-600 transition font-bold">></button>
                </div>
            </div>
        </div>
        <div class="text-center pt-12 mt-12 border-t border-stone-600/50 text-stone-400 text-xs">
            &copy; {{ date('Y') }} Whiskr. All rights reserved. 🐱
        </div>
    </footer>

</body>
</html>