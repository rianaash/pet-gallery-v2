<div class="min-h-screen bg-[#fffbf7] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        
        <div class="text-center mb-10">
            <h1 class="font-fredoka text-4xl font-black text-stone-800 mb-2">Upload Momen Anabul 📸</h1>
            <p class="font-sans text-stone-500 text-lg">Bagikan kelucuan anabulmu!</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-stone-100 overflow-hidden p-8 md:p-10">
            
            <form wire:submit="save" class="space-y-8">
                
                {{-- 1. AREA PREVIEW FOTO (Simpel: Kalau ada foto tampilkan, kalau gak ada tampilkan Placeholder) --}}
                <div class="flex flex-col items-center">
                    <div class="relative w-full h-80 bg-stone-50 rounded-[2rem] border-2 border-dashed border-stone-300 flex items-center justify-center overflow-hidden mb-4">
                        
                        {{-- Loading State (Muncul pas lagi milih file) --}}
                        <div wire:loading wire:target="photo" class="bg-white/80 z-20 flex flex-col items-center justify-center">
                            <svg class="animate-spin h-10 w-10 text-orange-500 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="font-fredoka text-stone-500">Sedang memproses...</span>
                        </div>

                        {{-- Kondisi: Tampilkan Preview --}}
                        @if ($photo && !$errors->has('photo'))
                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        @else
                            {{-- Kondisi: Belum ada foto --}}
                            <div class="text-center p-6 opacity-50">
                                <div class="text-6xl mb-2">🐱</div>
                                <span class="font-fredoka text-stone-400 text-lg">Preview foto akan muncul di sini</span>
                            </div>
                        @endif
                    </div>

                    {{-- 2. TOMBOL PILIH FILE (Input Standar tapi distyling dikit) --}}
                    <div class="w-full">
                        <label class="block mb-2 font-fredoka font-bold text-lg text-stone-700 ml-2">Pilih Foto</label>
                        <input wire:model="photo" 
                               type="file" 
                               accept="image/png, image/jpeg, image/jpg"
                               class="block w-full text-sm text-stone-500
                                      file:mr-4 file:py-3 file:px-6
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-bold file:font-fredoka
                                      file:bg-orange-100 file:text-orange-700
                                      hover:file:bg-orange-200
                                      cursor-pointer bg-stone-50 rounded-2xl border border-stone-200 p-2
                               ">
                        <p class="mt-2 text-sm text-stone-400 ml-2">Maksimal 2MB (JPG/PNG)</p>
                        @error('photo') <span class="text-rose-500 text-sm font-bold ml-2 mt-1 block">⚠️ {{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- 3. INPUT LAINNYA --}}
                <div class="space-y-6">
                    {{-- Kategori --}}
                    <div>
                        <label for="category" class="block mb-2 font-fredoka font-bold text-lg text-stone-700 ml-2">Jenis Hewan</label>
                        <select wire:model="category_id" id="category" class="font-sans w-full px-6 py-4 rounded-2xl bg-stone-50 border-2 border-stone-100 outline-none focus:border-orange-300 transition">
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-rose-500 text-sm font-bold ml-2 block">⚠️ Wajib dipilih ya!</span> @enderror
                    </div>

                    {{-- Judul --}}
                    <div>
                        <label for="title" class="block mb-2 font-fredoka font-bold text-lg text-stone-700 ml-2">Judul</label>
                        <input wire:model="title" type="text" placeholder="Judul foto..." class="font-sans w-full px-6 py-4 rounded-2xl bg-stone-50 border-2 border-stone-100 outline-none focus:border-orange-300 transition">
                        @error('title') <span class="text-rose-500 text-sm font-bold ml-2 block">⚠️ Judul harus diisi</span> @enderror
                    </div>

                    {{-- Caption --}}
                    <div>
                        <label for="caption" class="block mb-2 font-fredoka font-bold text-lg text-stone-700 ml-2">Caption</label>
                        <textarea wire:model="caption" rows="3" placeholder="Ceritanya apa..." class="font-sans w-full px-6 py-4 rounded-2xl bg-stone-50 border-2 border-stone-100 outline-none focus:border-orange-300 transition"></textarea>
                    </div>
                </div>

                {{-- 4. TOMBOL SUBMIT --}}
                <div class="pt-4 flex items-center justify-end gap-4 border-t border-stone-100">
                    <a href="{{ route('dashboard') }}" class="font-bold text-stone-400 hover:text-stone-600 px-4">Batal</a>
                    
                    <button type="submit" wire:loading.attr="disabled" class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-4 px-8 rounded-2xl shadow-lg transition transform active:scale-95 flex items-center gap-2 disabled:opacity-50">
                        <span wire:loading.remove wire:target="save">Upload Sekarang! </span>
                        <span wire:loading wire:target="save">Sabar ya... </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>