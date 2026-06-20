<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout)
    {
        $logout();

        return redirect('/');
    }
};
?>


<nav class="bg-white/80 border-b border-orange-100 sticky top-0 z-50 h-20 flex items-center shadow-sm backdrop-blur-md">
    <div class="max-w-7xl w-full mx-auto px-6 flex justify-between items-center gap-4">
        
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-orange-300 text-white rounded-2xl flex items-center justify-center shadow-lg transform -rotate-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paw-print-icon lucide-paw-print"><circle cx="11" cy="4" r="2"/><circle cx="18" cy="8" r="2"/><circle cx="20" cy="16" r="2"/>
                    <path d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/>
                </svg>
            </div>
            <span class="font-bold text-2xl tracking-tight text-stone-700 brand-font">Whiskr.</span>
        </div>

        <div class="flex-1 max-w-lg hidden md:block mx-8">
            <form action="{{ route('dashboard') }}" method="GET" class="relative group">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full border-2 border-orange-50 bg-orange-50/50 rounded-full py-3 pl-6 pr-12 text-sm focus:outline-none focus:border-orange-300 focus:bg-white focus:ring-2 focus:ring-orange-100 transition shadow-sm text-stone-600 placeholder:text-stone-400 font-medium"
                       placeholder="Cari hewan kesayanganmu...">
                
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white text-orange-400 hover:text-orange-500 hover:bg-orange-50 p-2 rounded-full flex items-center justify-center transition duration-300 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('upload.photo') }}" wire:navigate class="bg-orange-300 text-white px-6 py-3 rounded-full font-bold text-sm hover:bg-orange-500 transition shadow-[0_4px_0_rgb(251,146,60)] hover:shadow-[0_2px_0_rgb(251,146,60)] flex items-center gap-2 transform hover:translate-y-0.5 active:translate-y-1 border-b-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                    <span class="hidden lg:inline font-fredoka">Upload</span>
                </a>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 bg-white pl-1 pr-3 py-1 rounded-full border-2 border-orange-50 hover:border-orange-200 transition shadow-sm group">
                        <div class="w-9 h-9 rounded-full bg-orange-100 text-orange-500 font-bold flex items-center justify-center text-sm shadow-inner font-fredoka">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-stone-400 group-hover:text-orange-400 transition" :class="{'rotate-180': open}">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         wire:ignore.self
                         @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-90 translate-y-2"
                         x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                         class="absolute right-0 mt-3 w-60 bg-white rounded-[1.5rem] shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-orange-100/50 py-2 z-50 overflow-hidden font-medium" 
                         style="display: none;">
                        
                        <div class="px-6 py-4 border-b border-orange-50 bg-orange-50/30">
                            <p class="text-xs text-orange-400 font-bold uppercase tracking-wider mb-1 font-fredoka">Halo,</p>
                            <p class="text-base font-bold text-stone-700 truncate font-fredoka">{{ auth()->user()->name }}</p>
                        </div>
                        
                        <div class="p-2">
                             @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm text-amber-600 font-bold hover:bg-amber-50 rounded-xl transition flex items-center gap-3 mb-1">
                                    👑 Admin Panel
                                </a>
                            @endif
                            <a href="{{ route('my.profile') }}" wire:navigate class="block px-4 py-2.5 text-sm text-stone-600 hover:bg-orange-50 hover:text-orange-500 rounded-xl transition flex items-center gap-3">
                                👤 Akun Saya
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button
        type="submit"
        class="block w-full text-left px-4 py-2.5 text-sm text-rose-500 hover:bg-rose-50 rounded-xl font-bold"
    >
        🚪 Keluar
    </button>
</form>


                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" wire:navigate class="text-sm font-bold text-stone-500 px-5 py-2.5 hover:text-orange-500 transition font-fredoka">Masuk</a>
                <a href="{{ route('register') }}" wire:navigate class="text-sm font-bold bg-orange-400 text-white px-6 py-3 rounded-full hover:bg-orange-500 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 font-fredoka">Daftar Yuk!</a>
            @endauth
        </div>
    </div>
</nav>