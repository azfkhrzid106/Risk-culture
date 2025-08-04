<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\News;
use App\Models\BreakingNews;
use App\Http\Controllers\WelcomeController;


// ✅ Landing Page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'newsItems' => News::where('is_active', true)->latest()->get(),
        'breakingNews' => BreakingNews::first() ?? ['title' => '', 'isActive' => false]
    ]);
});

// ✅ Dashboard untuk user biasa
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'newsItems' => News::latest()->get(),
        'breakingNews' => BreakingNews::first() ?? ['title' => '', 'isActive' => false]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Admin Dashboard & CRUD Berita
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [NewsController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/admin/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::post('/admin/breaking-news', [NewsController::class, 'updateBreaking'])->name('breaking.update');
});

// ✅ Halaman Publik
Route::get('/profil', fn() => Inertia::render('Profil'));
Route::get('/download', fn() => Inertia::render('Download'));
Route::get('/galeri', fn() => Inertia::render('Galeri'));
Route::get('/kuis', fn() => Inertia::render('Kuis'));
Route::get('/kontak', fn() => Inertia::render('Kontak'));
Route::get('/safety/harian', fn() => Inertia::render('Safety/Harian'));
Route::get('/safety/bulanan', fn() => Inertia::render('Safety/Bulanan'));
Route::get('/video', fn() => Inertia::render('Video'));
Route::get('/survei', fn() => Inertia::render('Survei'));

// ✅ Auth
require __DIR__.'/auth.php';
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');