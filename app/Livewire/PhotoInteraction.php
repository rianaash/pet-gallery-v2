<?php

namespace App\Livewire;

use App\Models\Photo;
use App\Models\Comment; // Pastikan import Model Comment
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PhotoInteraction extends Component
{
    public Photo $photo;
    
    // Variabel Form Komentar
    public $content = '';
    
    // Variabel Logic Balas (Reply) - INI BARU
    public $replyToId = null;
    public $replyToName = null;

    // Status UI (Like & Bookmark)
    public $isLiked = false;
    public $likesCount = 0;
    public $isBookmarked = false;

    public function mount(Photo $photo)
    {
        $this->photo = $photo;
        $this->refreshStatus();
    }

    public function refreshStatus()
    {
        $this->likesCount = $this->photo->likes()->count();
        
        if (Auth::check()) {
            $user = Auth::user();
            $this->isLiked = $this->photo->isLikedBy($user);
            
            // Cek Bookmark
            try {
                $this->isBookmarked = $this->photo->bookmarks()
                    ->where('user_id', $user->id)
                    ->exists();
            } catch (\Exception $e) {
                $this->isBookmarked = false;
            }
        }
    }

    // --- FITUR 1: LIKE ---
    public function toggleLike()
    {
        if (!Auth::check()) return $this->redirect(route('login'), navigate: true);

        if ($this->isLiked) {
            $this->photo->likes()->where('user_id', Auth::id())->delete();
        } else {
            $this->photo->likes()->create(['user_id' => Auth::id()]);
        }
        
        $this->refreshStatus();
    }

    // --- FITUR 2: BOOKMARK ---
    public function toggleBookmark()
    {
        if (!Auth::check()) return $this->redirect(route('login'), navigate: true);

        $existing = $this->photo->bookmarks()->where('user_id', Auth::id())->first();

        if ($existing) {
            $existing->delete();
            $this->isBookmarked = false;
        } else {
            $this->photo->bookmarks()->create(['user_id' => Auth::id()]);
            $this->isBookmarked = true;
        }
    }


    public function setReply($commentId, $userName)
    {
        $this->replyToId = $commentId;
        $this->replyToName = $userName;
    }


    public function cancelReply()
    {
        $this->replyToId = null;
        $this->replyToName = null;
    }

    public function submitComment()
{
    if (!Auth::check()) {
        return $this->redirect(route('login'), navigate: true);
    }

    $this->validate([
        'content' => 'required|string|max:500',
    ]);

    Comment::create([
        'user_id'   => Auth::id(),
        'photo_id'  => $this->photo->id,
        'content'   => $this->content,
        'parent_id' => $this->replyToId,
    ]);


    $this->reset('content', 'replyToId', 'replyToName');
}

    // D. Hapus Komentar
    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id == Auth::id()) {
            $comment->delete();
        }
    }

    public function render()
    {
        // QUERY PENTING:
        // 1. whereNull('parent_id') -> Agar yang muncul di list utama cuma INDUK komentar
        // 2. with('replies.user')   -> Agar anak-anaknya (balasan) ikut terambil
        $comments = $this->photo->comments()
            ->with(['user', 'replies.user']) 
            ->whereNull('parent_id') 
            ->latest()
            ->get();

        return view('livewire.photo-interaction', [
            'comments' => $comments
        ]);
    }
}