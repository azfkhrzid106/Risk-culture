<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function galeri()
    {
        // Ensure storage link exists
        if (!file_exists(public_path('storage'))) {
            \Artisan::call('storage:link');
        }

        $newsItems = News::where('is_active', true)
            ->latest()
            ->paginate(12) // Bisa disesuaikan
            ->map(function ($news) {
                $imageUrl = null;

                if ($news->image_path) {
                    $fileExists = Storage::disk('public')->exists($news->image_path);

                    if ($fileExists) {
                        $imageUrl = asset('storage/' . $news->image_path);
                    }
                }

                return [
                    'id' => $news->id,
                    'title' => $news->title,
                    'content' => $news->content,
                    'category' => $news->category,
                    'is_active' => $news->is_active,
                    'image_url' => $imageUrl,
                    'image_path' => $news->image_path,
                    'created_at' => $news->created_at->toISOString(),
                ];
            });

        return inertia('Galeri', [
            'newsItems' => $newsItems
        ]);
    }
}
