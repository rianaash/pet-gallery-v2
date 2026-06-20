<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\WithPagination; // Biar ada halaman 1, 2, 3

#[Layout('layouts.admin')] // Pastikan ini sesuai nama file layout adminmu
class UserManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // PENTING: Biar paging-nya cocok sama AdminLTE

    public $search = '';

    public function render()
    {
        // Ambil user, filter kalau ada pencarian
        $users = User::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user-manager', [
            'users' => $users
        ]);
    }

    // Fungsi Hapus User
    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            // Jangan biarkan admin menghapus dirinya sendiri
            if ($user->id === auth()->id()) {
                session()->flash('error', 'Kamu tidak bisa menghapus akunmu sendiri!');
                return;
            }

            // Hapus user (otomatis foto & reportnya ikut terhapus kalau relasinya bener)
            $user->delete();
            session()->flash('message', 'User berhasil dihapus.');
        }
    }
}