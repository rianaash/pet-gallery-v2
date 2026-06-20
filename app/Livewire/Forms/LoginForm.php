<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';

    // 2. Fungsi Login (Ini yang dipanggil tombol submit)
    public function login()
    {
        // A. Validasi Input dulu
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // B. Coba Login ke Database
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi salah nih, coba cek lagi ya! 🧐',
            ]);
        }
        session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function render()
    {
        // Pastikan ini mengarah ke file view yang tadi kamu kirim
        return view('livewire.pages.auth.login'); 
    }
}