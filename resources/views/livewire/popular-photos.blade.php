<div class="mb-8 w-full">
    @if($popularPhotos->count() > 0)
        <div class="mb-4 flex items-end gap-3 px-2">
            <h2 class="font-fredoka text-2xl font-black text-stone-700">
                Sedang Hangat 🔥
            </h2>
        </div>

        {{-- GRID DIPERBAIKI: aspect-square (Persegi) & Gap lebih rapat --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($popularPhotos as $index => $pop)
                <a href="{{ route('photo.show', $pop->id) }}" class="group relative aspect-square w-full overflow-hidden rounded-2xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md bg-stone-100">
                    
                    {{-- Image --}}
                    <img src="{{ asset('storage/' . $pop->image_url) }}" 
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            alt="{{ $pop->title }}">
                    
                    {{-- Overlay (Lebih tipis biar tidak gelap banget) --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-60 transition group-hover:opacity-80"></div>

                    {{-- Badge Ranking (Kecil dipojok) --}}
                    <div class="absolute left-3 top-3 flex h-7 w-7 items-center justify-center rounded-full font-fredoka text-xs font-bold shadow-sm backdrop-blur-md
                        {{ $index == 0 ? 'bg-yellow-400 text-yellow-900' : '' }}
                        {{ $index == 1 ? 'bg-stone-300 text-stone-700' : '' }}
                        {{ $index == 2 ? 'bg-orange-700 text-orange-100' : '' }}
                        {{ $index > 2 ? 'bg-white/30 text-white' : '' }}
                    ">
                        #{{ $index + 1 }}
                    </div>

                    {{-- Info Text (Minimalis) --}}
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
    @endif
</div>