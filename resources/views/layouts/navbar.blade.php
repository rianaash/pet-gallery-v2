<nav class="bg-rose-50 border-b border-rose-200 sticky top-0 z-50 h-20 flex items-center shadow-sm backdrop-blur-md bg-opacity-95">
    <div class="max-w-7xl w-full mx-auto px-4 flex justify-between items-center gap-4">
        
        <a href="/" class="flex items-center gap-2 group shrink-0">
            <div class="bg-white p-2 rounded-xl shadow-sm border border-rose-100">
                <span class="text-2xl">🐾</span>
            </div>
            <span class="text-2xl font-extrabold text-rose-500 tracking-tight">Whiskr</span>
        </a>

        <div class="hidden md:flex items-center justify-center gap-8 flex-1">
            <a href="#populer" class="text-sm font-bold text-stone-500 hover:text-rose-500 transition relative group">
                Populer
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-rose-400 transition-all group-hover:w-full"></span>
            </a>
            <a href="#terbaru" class="text-sm font-bold text-stone-500 hover:text-rose-500 transition relative group">
                Terbaru
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-rose-400 transition-all group-hover:w-full"></span>
            </a>
            <a href="#" class="text-sm font-bold text-stone-500 hover:text-rose-500 transition relative group">
                Tentang Kami
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-rose-400 transition-all group-hover:w-full"></span>
            </a>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-bold text-rose-400 bg-white border border-rose-200 rounded-full hover:bg-rose-50 transition shadow-sm">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-rose-400 rounded-full hover:bg-rose-500 transition shadow-md">
                Daftar
            </a>
        </div>

    </div>
</nav>