<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = []; 

    // --- PERBAIKAN DISINI ---
    
    // Kita ganti nama fungsinya dari 'user' jadi 'reporter'.
    // Kenapa? Biar jelas ini adalah "Pelapor", bukan "User Biasa".
    // Dan biar cocok sama kode di Admin Controller tadi ($report->reporter->name).
    public function reporter() 
    { 
        // Pastikan parameter kedua ('reporter_user_id') sesuai sama nama kolom di database kamu
        return $this->belongsTo(User::class, 'reporter_user_id'); 
    }

    // Relasi ke Foto
    public function photo() 
    { 
        return $this->belongsTo(Photo::class); 
    }
}