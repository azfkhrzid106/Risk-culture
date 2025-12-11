<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TmrdController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\News;
use App\Models\BreakingNews;
use App\Models\Tmrd;

// ✅ Force HTTPS di Production
if (app()->environment('production')) {
    URL::forceScheme('https');
}

// ✅ Landing Page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// ✅ CSRF Token - Hanya untuk authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/csrf-token', function () {
        return response()->json(['csrf_token' => csrf_token()]);
    });
});

Route::get('/dashboard', function () {
    try {
        $files = \App\Models\File::orderBy('created_at', 'desc')->get();

        $documentsData = $files->map(function ($file) {
            return [
                'id'         => $file->id,
                'name'       => strip_tags($file->name), // XSS Protection
                'title'      => strip_tags($file->title ?? $file->name),
                'description'=> strip_tags($file->description ?? ''),
                'category'   => $file->category ?? 'general',
                'filename'   => $file->filename,
                'size'       => $file->size,
                'file_size'  => $file->size,
                'created_at' => $file->created_at,
                'updated_at' => $file->updated_at,
            ];
        });

        $tmrdData = Tmrd::latest()->get()->map(function ($tmrd) {
            return [
                'id' => $tmrd->id,
                'nip' => $tmrd->nip,
                'nama' => strip_tags($tmrd->nama),
                'tugas' => strip_tags($tmrd->tugas),
                'division' => strip_tags($tmrd->division),
                'email' => $tmrd->email,
                'jenis_kegiatan' => strip_tags($tmrd->jenis_kegiatan),
                'judul_kegiatan' => strip_tags($tmrd->judul_kegiatan),
                'tanggal' => $tmrd->tanggal,
                'waktu' => $tmrd->waktu,
                'tempat' => strip_tags($tmrd->tempat),
                'tujuan' => strip_tags($tmrd->tujuan),
                'hasil' => strip_tags($tmrd->hasil),
                'status' => $tmrd->status,
                'created_at' => $tmrd->created_at,
                'updated_at' => $tmrd->updated_at,
            ];
        });

        // Sanitize breaking news
        $breakingNews = BreakingNews::first();
        if ($breakingNews) {
            $breakingNews->title = strip_tags($breakingNews->title);
        }

        return Inertia::render('Dashboard', [
            'newsItems'    => News::latest()->get()->map(fn($n) => [
                'id' => $n->id,
                'title' => strip_tags($n->title),
                'content' => strip_tags($n->content),
                'created_at' => $n->created_at,
            ]),
            'breakingNews' => $breakingNews ?? ['title' => '', 'isActive' => false],
            'documents'    => $documentsData,
            'tmrdItems'    => $tmrdData
        ]);
    } catch (\Exception $e) {
        // Don't expose error details in production
        \Log::error('Dashboard error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return Inertia::render('Dashboard', [
            'newsItems'    => [],
            'breakingNews' => ['title' => '', 'isActive' => false],
            'documents'    => [],
            'tmrdItems'    => []
        ])->with('error', 'Terjadi kesalahan saat memuat data.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Admin Dashboard & CRUD - WITH ROLE CHECK
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Dashboard admin
    Route::get('/dashboard', [NewsController::class, 'index'])->name('admin.dashboard');

    // CRUD Berita
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Breaking news
    Route::post('/breaking-news', [NewsController::class, 'updateBreaking'])->name('breaking.update');

    // CRUD File dengan validasi ketat
    Route::post('/files', [FileController::class, 'store'])
        ->name('files.store');
    Route::put('/files/{id}', [FileController::class, 'update'])
        ->name('files.update');
    Route::delete('/files/{id}', [FileController::class, 'destroy'])
        ->name('files.destroy');

    // CRUD TMRD (Task Management Risk Documentation)
    Route::post('/tmrd', [TmrdController::class, 'store'])->name('tmrd.admin.store');
    Route::put('/tmrd/{tmrd}', [TmrdController::class, 'update'])->name('tmrd.update');
    Route::delete('/tmrd/{tmrd}', [TmrdController::class, 'destroy'])->name('tmrd.destroy');
    Route::get('/tmrd', [TmrdController::class, 'index'])->name('tmrd.index');
    Route::get('/tmrd/stats', [TmrdController::class, 'getStats'])->name('tmrd.stats');
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

// ✅ Halaman Download
Route::get('/download', [FileController::class, 'index'])->name('download');
Route::get('/download/{id}', [FileController::class, 'download'])
    ->middleware(['signed']) // Signed URL untuk keamanan
    ->name('files.download');

// ✅ TMRD Routes
Route::get('/tmrd', fn() => Inertia::render('TMRD'))->name('tmrd.form');

// ✅ TMRD Form Submission dengan Rate Limiting & CAPTCHA
Route::middleware(['web', 'throttle:5,1'])->group(function () {
    Route::post('/tmrd/submit', [TmrdController::class, 'submitPublic'])
        ->name('tmrd.submit.public');
});

// ✅ Auth
require __DIR__.'/auth.php';