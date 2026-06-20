<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use App\Models\Photo;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Create extends Component
{
    public Photo $photo; // Foto yang mau dilaporkan
    public $reason = '';
    public $description = '';

    // Tangkap ID foto dari URL
    public function mount(Photo $photo)
    {
        $this->photo = $photo;
    }

    protected $rules = [
        'reason' => 'required|string',
        'description' => 'nullable|string|max:500',
    ];

    public function submit()
    {
        $this->validate();

        Report::create([
            'reporter_user_id' => Auth::id(),
            'reported_photo_id' => $this->photo->id,
            'reason' => $this->reason,
            'description' => $this->description,
        ]);

        // Balikin ke dashboard dengan pesan
        session()->flash('message', 'Laporan kamu sudah kami terima. Admin akan segera mengeceknya!');  
    return redirect()->route('dashboard');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.reports.create');
    }
}