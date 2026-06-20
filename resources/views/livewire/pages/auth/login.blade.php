<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    // Variabel Input
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        // 1. Validasi Manual (Lebih aman)
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba Login
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Jika gagal, lempar error ke input email
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 3. Regenerate Session & Redirect
        Session::regenerate();
        $this->redirect(route('dashboard'));
    }
}; ?>

<div>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-stone-700 font-fredoka">Selamat Datang!</h2>
        <p class="text-stone-500 text-sm mt-3 font-medium">Masuk untuk melihat anabul lucumu.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login" wire:navigate.ignore>
        <div>
            <label for="email" class="block font-bold text-xs text-stone-500 uppercase tracking-wider mb-2 ml-3 font-fredoka">Email</label>
            <input wire:model="email" id="email" 
                   class="block w-full rounded-2xl border-2 border-stone-100 bg-stone-50/50 focus:border-orange-300 focus:ring-2 focus:ring-orange-100 focus:bg-white shadow-sm transition px-5 py-3.5 text-sm placeholder-stone-400 font-medium" 
                   type="email" name="email" required autofocus autocomplete="username" 
                   placeholder="nama@email.com" />
            <div class="mt-2 ml-3 text-rose-500 text-xs font-bold">
                @error('email') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="password" class="block font-bold text-xs text-stone-500 uppercase tracking-wider mb-2 ml-3 font-fredoka">Kata Sandi</label>
            <input wire:model="password" id="password" 
                   class="block w-full rounded-2xl border-2 border-stone-100 bg-stone-50/50 focus:border-orange-300 focus:ring-2 focus:ring-orange-100 focus:bg-white shadow-sm transition px-5 py-3.5 text-sm placeholder-stone-400 font-medium"
                   type="password" name="password" required autocomplete="current-password" 
                   placeholder="••••••••" />
            <div class="mt-2 ml-3 text-rose-500 text-xs font-bold">
                @error('password') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-col items-center justify-end mt-8 gap-4">
           <button type="submit" 
        wire:loading.attr="disabled"
        wire:target="login"
        class="w-full flex items-center justify-center bg-orange-300 hover:bg-orange-500 text-white font-black py-4 px-4 rounded-2xl shadow-[0_4px_0_rgb(251,146,60)] hover:shadow-[0_2px_0_rgb(251,146,60)] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition text-sm tracking-wide font-fredoka border-b-0 disabled:opacity-50 disabled:cursor-wait">
    
    <span wire:loading.remove wire:target="login">Masuk Sekarang!</span>
    
    <span wire:loading wire:target="login" class="flex items-center gap-2">
        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Tunggu sebentar...
    </span>
</button>
            
            <div class="text-sm font-medium text-stone-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" wire:navigate class="text-orange-400 hover:text-orange-500 font-bold transition ml-1 font-fredoka">
                    Daftar di sini
                </a>
            </div>
        </div>
    </form>
</div>