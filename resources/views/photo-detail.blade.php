<x-app-layout>
    <div class="py-6 min-h-[90vh] flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-6xl rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.08)] overflow-hidden grid grid-cols-1 lg:grid-cols-3 h-[85vh] border-4 border-white">
            <div class="lg:col-span-2 bg-stone-950 flex items-center justify-center relative h-full">
                <a href="{{ route('dashboard') }}" class="absolute top-6 left-6 z-10 bg-stone-900/50 hover:bg-stone-900/80 text-white p-3 rounded-full backdrop-blur-md transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 group-hover:-translate-x-1 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                 <img src="{{ asset('storage/' . $photo->image_url) }}" class="max-w-full max-h-full object-contain p-2" alt="{{ $photo->title }}">
            </div>
            <div class="lg:col-span-1 h-full bg-white relative">
                <livewire:photo-interaction :photo="$photo" />
            </div>
        </div>
    </div>
</x-app-layout>