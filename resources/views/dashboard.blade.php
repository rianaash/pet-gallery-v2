<x-app-layout>
    {{-- HEADER: HASIL PENCARIAN (Hanya muncul jika sedang mencari) --}}
    @if(request('search'))
    <div class="mb-4 bg-orange-50/50 border-b border-orange-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-4">
             <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-orange-400 rounded-full"></div>
                <h3 class="text-lg font-bold text-stone-700 font-fredoka">
                    Hasil pencarian: "{{ request('search') }}"
                </h3>
                <a href="{{ route('dashboard') }}" class="text-xs text-orange-400 hover:text-orange-600 font-bold bg-white border border-orange-100 px-3 py-1 rounded-full transition ml-auto">
                    Reset ✕
                </a>
             </div>
        </div>
    </div>
    @endif

    <div class="mx-auto max-w-7xl px-4 lg:px-8 py-6">
        
        {{-- === SECTION 1: POPULAR PHOTOS (Manual Blade Loop) === --}}
        {{-- Hanya muncul jika tidak sedang mencari & ada datanya --}}
        @if(!request('search') && $popularPhotos->count() > 0)
            <div class="mb-8 w-full">
                <div class="mb-4 flex items-end gap-3 px-2">
                    <h2 class="font-fredoka text-2xl font-black text-stone-700">
                        Sedang Hangat 🔥
                    </h2>
                </div>

                {{-- GRID PERSEGI (ASPECT-SQUARE) --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($popularPhotos as $index => $pop)
                        <a href="{{ route('photo.show', $pop->id) }}" class="group relative aspect-square w-full overflow-hidden rounded-2xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md bg-stone-100">
                            
                            {{-- Image --}}
                            <img src="{{ asset('storage/' . $pop->image_url) }}" 
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                                    alt="{{ $pop->title }}">
                            
                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-60 transition group-hover:opacity-80"></div>

                            {{-- Badge Ranking --}}
                            <div class="absolute left-3 top-3 flex h-7 w-7 items-center justify-center rounded-full font-fredoka text-xs font-bold shadow-sm backdrop-blur-md
                                {{ $index == 0 ? 'bg-yellow-400 text-yellow-900' : '' }}
                                {{ $index == 1 ? 'bg-stone-300 text-stone-700' : '' }}
                                {{ $index == 2 ? 'bg-orange-700 text-orange-100' : '' }}
                                {{ $index > 2 ? 'bg-white/30 text-white' : '' }}
                            ">
                                #{{ $index + 1 }}
                            </div>

                            {{-- Info Text --}}
                            <div class="absolute bottom-0 w-full p-3 text-white">
                                <h3 class="line-clamp-1 font-fredoka text-sm font-bold leading-tight group-hover:text-orange-200 transition">
                                    {{ $pop->title }}
                                </h3>
                                <div class="mt-1 flex items-center gap-1 text-[10px] font-medium text-stone-200">
                                    <span>❤️ {{ $pop->likes_count }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Separator Garis --}}
            <div class="border-t border-stone-100 my-8"></div>
        @endif

        {{-- === SECTION 2: FEED UTAMA (Masonry) === --}}
        <div class="pb-12">
            <h2 class="font-fredoka font-black text-2xl text-stone-700 mb-6 leading-tight flex items-center gap-2">
                Jelajahi <span class="text-orange-500 bg-orange-50 px-2 py-0.5 rounded-lg border border-orange-100">Feed</span> 📸
            </h2>

            @if($photos->count() > 0)
                <div class="columns-2 md:columns-3 lg:columns-4 gap-5 space-y-5">
                    @foreach($photos as $photo)
                        <div class="masonry-item relative group rounded-3xl overflow-hidden bg-white break-inside-avoid border border-stone-100 shadow-sm hover:shadow-lg transition duration-500">
                            <a href="{{ route('photo.show', $photo->id) }}" class="block w-full relative">
                                
                                <img src="{{ asset('storage/' . $photo->image_url) }}" 
                                     class="w-full h-auto block transform group-hover:scale-105 transition duration-700 ease-in-out">
                                
                                {{-- Gradient Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                                {{-- Content on Hover --}}
                                <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition duration-300 z-10">
                                    <h4 class="text-white font-bold truncate text-sm font-fredoka drop-shadow-md">{{ $photo->title }}</h4>
                                    
                                    <div class="flex items-center gap-2 mt-2">
                                         <div class="w-5 h-5 rounded-full bg-orange-500 text-white flex items-center justify-center text-[9px] font-bold border border-white">
                                            {{ substr($photo->user->name, 0, 1) }}
                                         </div>
                                         <span class="text-stone-200 text-xs font-medium drop-shadow-md">{{ $photo->user->name }}</span>
                                    </div>
                                </div>

                                {{-- Like Badge --}}
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-2 py-1 rounded-full text-[10px] font-bold text-stone-600 flex items-center gap-1 shadow-sm opacity-0 group-hover:opacity-100 transition duration-300 delay-75">
                                    <span class="text-rose-500">❤️</span> 
                                    {{ $photo->likes_count }} 
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12 px-2">
                    {{ $photos->links() }}
                </div>
            @else
                {{-- Tampilan Kosong --}}
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="text-6xl mb-4 grayscale opacity-30">📷</div>
                    <p class="font-fredoka text-lg text-stone-500">Belum ada foto yang diunggah.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>