<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id', // <--- PENTING: Tambahkan ini
        'image_url',   // Pastikan sesuai nama kolom di DB (bisa 'image' atau 'image_path')
        'title',
        'caption',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- RELASI KATEGORI (SOLUSI ERROR ANDA) ---
    public function category(): BelongsTo
    {
        // Pastikan Anda punya model App\Models\Category
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Komentar
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi ke Likes
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // Helper: Cek Like
    public function isLikedBy($user): bool
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function bookmarks()
{
    return $this->hasMany(Bookmark::class);
}
}