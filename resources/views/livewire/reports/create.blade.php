<div class="min-h-screen bg-[#fffbf7] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl mx-auto">
        
        <div class="text-center mb-8">
            <h1 class="font-fredoka text-3xl font-black text-stone-800 mb-2">Ada yang gak beres? 🤔</h1>
            <p class="font-sans text-stone-500">Bantu kami menjaga Whiskr tetap aman dan nyaman buat semua anabul.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-[0_10px_40px_rgba(0,0,0,0.05)] border border-stone-100 overflow-hidden p-8">
            
            <div class="flex items-center gap-4 mb-8 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                <img src="{{ asset('storage/' . $photo->image_url) }}" class="w-16 h-16 rounded-xl object-cover">
                <div>
                    <p class="font-fredoka font-bold text-stone-700">Melaporkan postingan:</p>
                    <p class="font-sans text-sm text-stone-500 line-clamp-1">"{{ $photo->title }}"</p>
                    <p class="font-sans text-xs text-stone-400">Oleh: {{ $photo->user->name }}</p>
                </div>
            </div>

            <form wire:submit="submit" class="space-y-6">
                
                <div>
                    <label class="block mb-3 font-fredoka font-bold text-lg text-stone-700">Kenapa foto ini dilaporkan?</label>
                    <div class="space-y-3">
                        @php
                            $reasons = [
                                'Spam' => 'Isinya iklan, spam, atau gak jelas',
                                'Inappropriate' => 'Foto tidak pantas / kasar',
                                'Not a Cat' => 'Ini bukan kucing/hewan (Konten OOT)',
                                'Stolen' => 'Ini foto saya yang diambil orang lain',
                            ];
                        @endphp

                        @foreach($reasons as $value => $label)
                        <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition hover:bg-orange-50"
                               :class="reason === '{{ $value }}' ? 'border-orange-400 bg-orange-50' : 'border-stone-100'">
                            <input type="radio" wire:model="reason" value="{{ $value }}" class="text-orange-500 focus:ring-orange-400 h-5 w-5 border-gray-300">
                            <span class="ml-3 font-sans font-medium text-stone-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('reason') <span class="text-rose-500 text-sm font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="desc" class="block mb-2 font-fredoka font-bold text-lg text-stone-700">Ada detail lain?</label>
                    <textarea wire:model="description" id="desc" rows="3" 
                              class="font-sans w-full px-5 py-3 rounded-xl bg-stone-50 border-2 border-stone-100 focus:border-orange-300 focus:bg-white focus:ring-4 focus:ring-orange-100 transition outline-none placeholder-stone-400"
                              placeholder="Ceritain dikit biar admin paham..."></textarea>
                </div>

                <div class="flex gap-4 pt-2">
                    <a href="{{ route('dashboard') }}" class="flex-1 py-3 font-fredoka font-bold text-stone-400 text-center hover:text-stone-600">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-rose-500 hover:bg-rose-600 text-white py-3 rounded-xl font-fredoka font-bold shadow-[0_4px_0_rgb(225,29,72)] hover:shadow-[0_2px_0_rgb(225,29,72)] hover:translate-y-0.5 transition active:shadow-none active:translate-y-1">
                        🚨 Kirim Laporan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

