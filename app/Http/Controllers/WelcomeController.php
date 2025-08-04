<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\BreakingNews;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ensure storage link exists
        if (!file_exists(public_path('storage'))) {
            \Artisan::call('storage:link');
        }

        $newsItems = News::where('is_active', true)
            ->latest()
            ->get()
            ->map(function ($news) {
                $imageUrl = null;
                
                if ($news->image_path) {
                    $fileExists = Storage::disk('public')->exists($news->image_path);
                    \Log::info("Welcome - Image check for {$news->title}: path={$news->image_path}, exists={$fileExists}");
                    
                    if ($fileExists) {
                        $imageUrl = asset('storage/' . $news->image_path);
                        \Log::info("Welcome - Generated URL: {$imageUrl}");
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

        $breakingNews = BreakingNews::first();
        if (!$breakingNews) {
            $breakingNews = (object) ['title' => '', 'isActive' => false];
        }

        \Log::info('Welcome data:', [
            'newsCount' => $newsItems->count(),
            'newsWithImages' => $newsItems->where('image_url', '!=', null)->count(),
            'firstNewsImageUrl' => $newsItems->first()['image_url'] ?? 'none'
        ]);

        return Inertia::render('Welcome', [
            'newsItems' => $newsItems,
            'breakingNews' => $breakingNews
        ]);
    }
}