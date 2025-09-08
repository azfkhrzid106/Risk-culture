<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\News;
use App\Models\BreakingNews;

// ✅ Landing Page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    try {
        $files = \App\Models\File::orderBy('created_at', 'desc')->get();
        
        $documentsData = $files->map(function ($file) {
            return [
                'id' => $file->id,
                'name' => $file->name,
                'title' => $file->title ?? $file->name, // ✅ GUNAKAN FIELD TITLE
                'description' => $file->description ?? '',
                'category' => $file->category ?? 'general',
                'filename' => $file->filename,
                'size' => $file->size,
                'file_size' => $file->size,
                'created_at' => $file->created_at,
                'updated_at' => $file->updated_at,
            ];
        });

        return Inertia::render('Dashboard', [
            'newsItems' => News::latest()->get(),
            'breakingNews' => BreakingNews::first() ?? ['title' => '', 'isActive' => false],
            'documents' => $documentsData
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Dashboard error: ' . $e->getMessage());
        
        return Inertia::render('Dashboard', [
            'newsItems' => News::latest()->get(),
            'breakingNews' => BreakingNews::first() ?? ['title' => '', 'isActive' => false],
            'documents' => []
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Admin Dashboard & CRUD Berita
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [NewsController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/admin/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::post('/admin/breaking-news', [NewsController::class, 'updateBreaking'])->name('breaking.update');

    // ✅ CRUD File (hanya admin) - PERBAIKAN: Tambah route update
    Route::post('/files', [FileController::class, 'store'])->name('files.store');
    Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update'); // ✅ TAMBAHAN BARU
    Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');
});

// ✅ Halaman Publik
Route::get('/profil', fn() => Inertia::render('Profil'))->name('profil');
Route::get('/kuis', fn() => Inertia::render('Kuis'))->name('kuis');
Route::get('/kontak', fn() => Inertia::render('Kontak'))->name('kontak');
Route::get('/safety/harian', fn() => Inertia::render('Safety/Harian'))->name('safety.harian');
Route::get('/safety/bulanan', fn() => Inertia::render('Safety/Bulanan'))->name('safety.bulanan');
Route::get('/video', fn() => Inertia::render('Video'))->name('video');
Route::get('/survei', fn() => Inertia::render('Survei'))->name('survei');

// ✅ Route Galeri
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');

// ✅ Halaman Download (public bisa lihat & download) - FIXED
Route::get('/download', [FileController::class, 'index'])->name('download');
Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');

// ✅ Auth
require __DIR__.'/auth.php';