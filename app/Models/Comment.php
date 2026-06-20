<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_id',
        'content',
        'parent_id', // PENTING: agar bisa simpan balasan
    ];

    // Relasi ke User yang berkomentar
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Foto
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class);
    }

    // Relasi: Komentar Induk (Parent)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi: Balasan (Children)
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}