<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Photo;

class PopularPhotos extends Component
{
    public function render()
    {
        // Ambil 4 foto dengan like terbanyak
        $popularPhotos = Photo::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(4)
            ->get();

        return view('livewire.popular-photos', [
            'popularPhotos' => $popularPhotos
        ]);
    }
}