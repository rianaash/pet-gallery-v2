<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request; // Jangan lupa import ini

// --- IMPORT MODELS ---
use App\Models\Photo;
use App\Models\User;
use App\Models\Like;

// --- IMPORT LIVEWIRE COMPONENTS ---
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\CategoryManager;
use App\Livewire\Admin\PhotoManager;
use App\Livewire\Admin\ReportManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\PhotoInteraction;
use App\Livewire\Reports\Create;
use App\Livewire\User\UploadPhoto;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN DEPAN (LANDING PAGE - GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', function (Request $request) {
    
    // 1. Cek User Login -> Lempar ke Dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    // 2. Query FOTO POPULER (Top 4)
    $popularPhotos = Photo::with(['user', 'category'])
        ->withCount('likes')
        ->has('likes')                   // Minimal 1 like
        ->orderBy('likes_count', 'desc') // Urutkan terbanyak
        ->take(4)                        // Ambil 4
        ->get();

    // 3. Query FOTO TERBARU (Search Logic)
    $query = Photo::with(['user', 'category', 'likes']);

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('title', 'like', '%' . $search . '%')
              ->orWhereHas('category', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              });
    }

    $photos = $query->latest()->get();

    // 4. Kirim Data ke View
    return view('welcome', [
        'photos' => $photos,
        'popularPhotos' => $popularPhotos
    ]);

})->name('home');

/*
|--------------------------------------------------------------------------
| 2. HALAMAN PUBLIK (Bisa diakses Siapa Saja)
|--------------------------------------------------------------------------
| Route ini ditaruh DI LUAR middleware auth agar Tamu bisa lihat detail.
*/

// Detail Foto
Route::get('/photo/{photo}', PhotoInteraction::class)->name('photo.show');

// Download Foto
Route::get('/download/{id}', function ($id) {
    $photo = Photo::findOrFail($id);
    return Storage::disk('public')->download($photo->image_url);
})->name('photo.download');


/*
|--------------------------------------------------------------------------
| 3. AREA USER (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // DASHBOARD (Feed User)
    Route::get('/dashboard', function (Request $request) {
        
        // 1. Query Populer (Agar Dashboard juga punya data ini)
        $popularPhotos = Photo::with(['user', 'category'])
            ->withCount('likes')
            ->has('likes')
            ->orderBy('likes_count', 'desc')
            ->take(4)
            ->get();

        // 2. Query Utama
        $query = Photo::with('user', 'category')
    ->withCount('likes') // <--- TAMBAHKAN INI AGAR FEED UTAMA MUNCUL ANGKA LIKENYA
    ->latest();

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $cari = $request->search;
            $query->where(function($q) use ($cari) {
                $q->where('title', 'like', '%' . $cari . '%')
                  ->orWhere('caption', 'like', '%' . $cari . '%')
                  ->orWhereHas('category', function($c) use ($cari){
                      $c->where('name', 'like', '%' . $cari . '%');
                  });
            });
        }

        $photos = $query->paginate(12);

        return view('dashboard', [
            'photos' => $photos,
            'popularPhotos' => $popularPhotos 
        ]);
        
    })->name('dashboard');
    Route::get('/upload', UploadPhoto::class)->name('upload.photo');
    Route::get('/report/{photo}', Create::class)->name('report.create');
    Route::get('/download/{photo}', function (Photo $photo) {
    if (Storage::disk('public')->exists($photo->image_url)) {
        return Storage::disk('public')->download($photo->image_url, 'Anabul-'.$photo->id.'.jpg');
    }
    return back()->with('error', 'File tidak ditemukan!');
})->name('photo.download');
    Route::get('/me', \App\Livewire\UserProfile::class)->name('my.profile');
    Route::view('profile', 'profile')->name('profile');
    Route::post('/toggle-like/{id}', function ($id) {
        $userId = Auth::id();
        $photo = Photo::findOrFail($id);
        $existingLike = Like::where('user_id', $userId)->where('photo_id', $photo->id)->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create(['user_id' => $userId, 'photo_id' => $photo->id]);
        }
        return back();
    })->name('like.toggle');
});

/*
|--------------------------------------------------------------------------
| 4. AREA ADMIN (Wajib Login + Role Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/categories', CategoryManager::class)->name('categories');
    Route::get('/photos', PhotoManager::class)->name('photos');
    Route::get('/admin/reports', ReportManager::class)->name('reports');
    Route::get('/admin/users', UserManager::class)->name('users');
});

/*
|--------------------------------------------------------------------------
| 5. AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::guard('web')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';