<div class="bg-[#fffbf7] min-h-screen py-8 px-4 md:px-8">
    <div class="max-w-6xl mx-auto">
        
        {{-- TOMBOL KEMBALI --}}
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 font-bold text-stone-500 transition hover:text-orange-500">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-sm ring-1 ring-stone-100 transition group-hover:ring-orange-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 transition group-hover:-translate-x-0.5">
                        <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="font-fredoka">Kembali ke Beranda</span>
            </a>
        </div>

        {{-- MAIN CARD (FIX: Added overflow-hidden properly and flex handling) --}}
        <div class="flex flex-col overflow-hidden rounded-[2.5rem] border border-stone-100 bg-white shadow-[0_10px_40px_rgba(0,0,0,0.05)] lg:flex-row lg:h-[85vh] min-h-[600px]">
            
            {{-- KIRI: FOTO --}}
            <div class="relative flex w-full items-center justify-center bg-stone-50/50 p-6 lg:w-[60%] lg:border-r border-stone-100 lg:h-full">
                <img src="{{ asset('storage/' . $photo->image_url) }}" 
                     alt="{{ $photo->title }}" 
                     class="max-h-full max-w-full rounded-3xl object-contain shadow-sm transition duration-700 hover:scale-[1.02]">
            </div>

            {{-- KANAN: DETAIL & KOMENTAR --}}
            <div class="flex w-full flex-col bg-white lg:w-[40%] h-full">
                
                {{-- HEADER (User Info & Dropdown) --}}
                <div class="flex-shrink-0 flex items-center justify-between border-b border-stone-100 p-6 pb-4">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($photo->user->name) }}&background=random&color=78716c&background=f5f5f4" 
                             class="h-12 w-12 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <h3 class="font-fredoka text-lg font-bold text-stone-800 leading-tight">{{ $photo->user->name }}</h3>
                            <p class="text-xs font-medium text-stone-400">{{ $photo->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    {{-- MENU DROPDOWN --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex h-9 w-9 items-center justify-center rounded-full text-stone-400 hover:bg-stone-100 hover:text-stone-600 transition focus:outline-none active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12a.75.75 0 110-1.5.75.75 0 010 1.5zM12 17.25a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" style="display: none;" class="absolute right-0 top-full mt-2 w-48 origin-top-right rounded-2xl border border-stone-100 bg-white shadow-[0_10px_40px_rgba(0,0,0,0.08)] z-50 overflow-hidden">
                            <div class="p-1">
                                <a href="{{ route('report.create', $photo->id) }}" class="flex w-full items-center gap-2 rounded-xl px-4 py-3 text-left font-fredoka text-sm font-bold text-rose-500 transition hover:bg-rose-50 hover:text-rose-600">
                                    Laporkan Foto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- JUDUL & ACTION BUTTONS (Scrollable part starts here if needed, but keeping separate is better) --}}
                <div class="flex-shrink-0 px-6 pt-4">
                    <h1 class="mb-2 font-fredoka text-2xl font-black leading-tight text-stone-800">{{ $photo->title }}</h1>
                    <p class="text-sm leading-relaxed text-stone-600">{{ $photo->caption }}</p>

                    <div class="mt-6 flex items-center justify-around rounded-2xl bg-[#fffbf7] py-3 px-4 border border-stone-100">
                        {{-- 1. LIKE --}}
                        <button wire:click="toggleLike" class="group flex flex-col items-center gap-1">
                            <div class="rounded-full p-2 transition {{ $isLiked ? 'bg-rose-100 text-rose-500' : 'text-stone-400 group-hover:bg-white group-hover:text-rose-500' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $isLiked ? 'fill-current' : 'fill-none' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold {{ $isLiked ? 'text-rose-500' : 'text-stone-500' }}">{{ $likesCount }}</span>
                        </button>

                        {{-- 2. BOOKMARK --}}
                        <button wire:click="toggleBookmark" class="group flex flex-col items-center gap-1">
                            <div class="rounded-full p-2 transition {{ $isBookmarked ? 'bg-amber-100 text-amber-500' : 'text-stone-400 group-hover:bg-white group-hover:text-amber-500' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $isBookmarked ? 'fill-current' : 'fill-none' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold {{ $isBookmarked ? 'text-amber-500' : 'text-stone-500' }}">Simpan</span>
                        </button>

                        {{-- 3. UNDUH (SVG Kamu) --}}
                        <a href="{{ route('photo.download', $photo->id) }}" class="group flex flex-col items-center gap-1">
                            <div class="rounded-full p-2 text-stone-400 transition group-hover:bg-white group-hover:text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-stone-500 transition group-hover:text-emerald-500">Unduh</span>
                        </a>

                        {{-- 4. SHARE --}}
                        <div x-data="{ copied: false }">
                            <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)" class="group flex flex-col items-center gap-1">
                                <div class="rounded-full p-2 text-stone-400 transition group-hover:bg-white group-hover:text-sky-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                    </svg>
                                </div>
                                <span x-text="copied ? 'Disalin!' : 'Bagikan'" class="text-xs font-bold transition" :class="copied ? 'text-sky-500' : 'text-stone-500'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- DAFTAR KOMENTAR (FIX: min-h-0 and flex-1 allows proper scrolling) --}}
                <div class="flex-1 overflow-y-auto p-6 custom-scrollbar space-y-5 min-h-0">
                    <h3 class="font-fredoka text-sm font-bold uppercase tracking-wider text-stone-400">Komentar ({{ $comments->count() }})</h3>
                    
                    @forelse($comments as $comment)
                        {{-- KOMENTAR UTAMA --}}
                        <div class="flex gap-3 animate-fadeIn group relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=78716c&background=f5f5f4" 
                                 class="mt-1 h-8 w-8 flex-shrink-0 rounded-full shadow-sm">
                            
                            <div class="flex-1">
                                <div class="rounded-2xl rounded-tl-none border border-stone-100 bg-[#fffbf7] p-3 shadow-sm transition group-hover:bg-white group-hover:shadow-md">
                                    <div class="mb-1 flex items-baseline justify-between">
                                        <span class="font-fredoka text-sm font-bold text-stone-700">{{ $comment->user->name }}</span>
                                        <span class="text-[10px] font-medium text-stone-400">{{ $comment->created_at->shortAbsoluteDiffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm leading-snug text-stone-600">{{ $comment->content }}</p>
                                </div>
                                
                                {{-- TOMBOL BALAS (Reply) --}}
                                <div class="mt-1 flex gap-3 px-2">
                                    <button wire:click="setReply({{ $comment->id }}, '{{ $comment->user->name }}')" 
                                            class="text-[11px] font-bold text-stone-400 hover:text-orange-500 transition">
                                        Balas
                                    </button>
                                    @if(auth()->id() == $comment->user_id)
                                        <button wire:click="deleteComment({{ $comment->id }})" class="text-[11px] font-bold text-stone-400 hover:text-rose-500 transition">
                                            Hapus
                                        </button>
                                    @endif
                                </div>

                                {{-- CHILD KOMENTAR (BALASAN) --}}
                                @if($comment->replies->count() > 0)
                                    <div class="mt-3 space-y-3">
                                        @foreach($comment->replies as $reply)
                                            <div class="flex gap-2">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background=random&color=78716c&background=f5f5f4" 
                                                     class="h-6 w-6 flex-shrink-0 rounded-full grayscale opacity-70">
                                                
                                                <div class="flex-1">
                                                    <div class="rounded-xl rounded-tl-none border border-stone-100 bg-stone-50 p-2.5">
                                                        <div class="flex items-baseline justify-between">
                                                            <span class="font-fredoka text-xs font-bold text-stone-600">{{ $reply->user->name }}</span>
                                                        </div>
                                                        <p class="text-xs leading-snug text-stone-500">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="flex h-40 flex-col items-center justify-center text-center text-stone-400">
                            <div class="mb-2 text-4xl opacity-30 grayscale">💬</div>
                            <p class="font-fredoka text-sm">Belum ada yang berkomentar.</p>
                            <p class="text-xs">Jadilah yang pertama!</p>
                        </div>
                    @endforelse
                </div>

                {{-- FORM KOMENTAR --}}
                <div class="border-t border-stone-100 bg-white p-4">
                    {{-- INDIKATOR SEDANG MEMBALAS --}}
                    @if($replyToId)
                        <div class="mb-2 flex items-center justify-between rounded-lg bg-orange-50 px-3 py-1.5 text-xs text-orange-600 border border-orange-100 animate-fadeIn">
                            <span>Membalas <b>{{ $replyToName }}</b></span>
                            <button wire:click="cancelReply" class="font-bold hover:text-orange-800">Batal ✕</button>
                        </div>
                    @endif

                    @auth
                        <form wire:submit.prevent="submitComment" class="relative flex items-center">
                            <textarea wire:model="content"
                                      class="w-full resize-none rounded-2xl border-2 border-stone-100 bg-stone-50 py-3 pl-4 pr-14 text-sm text-stone-700 placeholder-stone-400 transition focus:border-orange-300 focus:bg-white focus:ring-2 focus:ring-orange-100"
                                      rows="1"
                                      placeholder="{{ $replyToId ? 'Tulis balasanmu...' : 'Tulis komentar manis...' }}"></textarea>
                            
                            <button type="submit" 
                                    class="absolute right-2 rounded-xl bg-orange-400 p-2 text-white shadow-sm transition hover:bg-orange-500 hover:shadow-md active:scale-95 disabled:opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="h-5 w-5 transform" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m16 12-4-4-4 4"/><path d="M12 16V8"/></svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-orange-200 bg-orange-50 py-3 font-fredoka text-sm font-bold text-orange-500 transition hover:bg-orange-100 hover:border-orange-300">
                            <span>🔒</span> Masuk untuk ikut ngobrol
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>