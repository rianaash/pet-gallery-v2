<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <--- WAJIB IMPORT INI
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        // 1. Validasi Input
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. ENKRIPSI PASSWORD SEBELUM SIMPAN (Ini yang bikin login error sebelumnya)
        $validated['password'] = Hash::make($validated['password']);

        // 3. Simpan User ke Database
        $user = User::create($validated);

        // 4. Trigger Event Registered (Opsional, buat verifikasi email)
        event(new Registered($user));

        // 5. Auto Login
        Auth::login($user);

        // 6. Redirect ke Dashboard
        $this->redirect(route('dashboard'));
    }
}; ?>
<div>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-extrabold text-stone-800">Gabung Komunitas! 🐾</h2>
        <p class="text-stone-500 text-sm mt-2">Buat akun baru hanya dalam hitungan detik.</p>
    </div>

    <form wire:submit.prevent="register">
        <div>
            <label for="name" class="block font-bold text-xs text-stone-600 uppercase tracking-wider mb-1 ml-2">Nama Lengkap</label>
            <input wire:model="name" id="name" class="block mt-1 w-full rounded-full border-stone-200 bg-stone-50 focus:border-rose-400 focus:ring-rose-400 shadow-sm transition px-5 py-3 text-sm placeholder-stone-400" 
                   type="text" name="name" required autofocus autocomplete="name" 
                   placeholder="Contoh: Budi Santoso" />
            <div class="mt-2 ml-2 text-red-500 text-xs">
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="email" class="block font-bold text-xs text-stone-600 uppercase tracking-wider mb-1 ml-2">Email</label>
            <input wire:model="email" id="email" class="block mt-1 w-full rounded-full border-stone-200 bg-stone-50 focus:border-rose-400 focus:ring-rose-400 shadow-sm transition px-5 py-3 text-sm placeholder-stone-400" 
                   type="email" name="email" required autocomplete="username" 
                   placeholder="nama@email.com" />
            <div class="mt-2 ml-2 text-red-500 text-xs">
                @error('email') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="password" class="block font-bold text-xs text-stone-600 uppercase tracking-wider mb-1 ml-2">Kata Sandi</label>
            <input wire:model="password" id="password" class="block mt-1 w-full rounded-full border-stone-200 bg-stone-50 focus:border-rose-400 focus:ring-rose-400 shadow-sm transition px-5 py-3 text-sm placeholder-stone-400" 
                   type="password" name="password" required autocomplete="new-password" 
                   placeholder="Minimal 8 karakter" />
            <div class="mt-2 ml-2 text-red-500 text-xs">
                @error('password') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="password_confirmation" class="block font-bold text-xs text-stone-600 uppercase tracking-wider mb-1 ml-2">Konfirmasi Kata Sandi</label>
            
            <input wire:model="password_confirmation" 
                   id="password_confirmation" 
                   class="block mt-1 w-full rounded-full border-stone-200 bg-stone-50 focus:border-rose-400 focus:ring-rose-400 shadow-sm transition px-5 py-3 text-sm placeholder-stone-400" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Ulangi kata sandi tadi" />
            
            </div>

        <div class="flex flex-col items-center justify-end mt-8 gap-4">
            <button type="submit" class="w-full justify-center bg-rose-400 hover:bg-rose-500 text-white font-bold py-3.5 px-4 rounded-full shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 active:translate-y-0 text-sm tracking-wide">
                <span wire:loading.remove>DAFTAR SEKARANG</span>
                <span wire:loading>Memproses... ⏳</span>
            </button>

            <a class="text-sm text-stone-600 hover:text-rose-500 transition mt-2" href="{{ route('login') }}" wire:navigate>
                Sudah punya akun? <span class="font-bold underline decoration-rose-300">Masuk</span>
            </a>
        </div>
    </form>
</div>