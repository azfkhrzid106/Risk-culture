<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\BreakingNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::orderBy('created_at', 'desc')->get()->map(function ($news) {
            // DEBUGGING: Check if files exist
            $imageUrl = null;
            if ($news->image_path) {
                // Check if file exists in storage
                $fileExists = Storage::disk('public')->exists($news->image_path);
                \Log::info("Image check for {$news->title}: path={$news->image_path}, exists={$fileExists}");
                
                if ($fileExists) {
                    // Try multiple URL generation methods
                    $imageUrl = asset('storage/' . $news->image_path);
                    // Alternative: $imageUrl = Storage::disk('public')->url($news->image_path);
                    
                    \Log::info("Generated URL: {$imageUrl}");
                }
            }

            return [
                'id' => $news->id,
                'title' => $news->title,
                'content' => $news->content,
                'category' => $news->category,
                'is_active' => $news->is_active,
                'image_url' => $imageUrl,
                'image_path' => $news->image_path, // Keep for debugging
                'created_at' => $news->created_at,
                'updated_at' => $news->updated_at,
            ];
        });

        // Debug log
        \Log::info('NewsItems sent to frontend:', $newsItems->toArray());

        return Inertia::render('Admin/Dashboard', [
            'newsItems' => $newsItems,
            'breakingNews' => BreakingNews::first() ?? ['title' => '', 'isActive' => false]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:info,safety,announcement,event',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'is_active' => $validated['is_active'],
        ];

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('news-images', $filename, 'public');
            $data['image_path'] = $imagePath;
            
            // Debug log
            \Log::info('Image stored at: ' . $imagePath);
        }

        $news = News::create($data);
        
        // Debug log
        \Log::info('News created with image_path: ' . $news->image_path);

        return redirect()->route('admin.dashboard')->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:info,safety,announcement,event',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'is_active' => $validated['is_active'],
        ];

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('news-images', $filename, 'public');
            $data['image_path'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Informasi berhasil diupdate!');
    }

    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Informasi berhasil dihapus!');
    }

    public function updateBreaking(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'isActive' => 'required|boolean'
        ]);

        $breakingNews = BreakingNews::first();
        if ($breakingNews) {
            $breakingNews->update($validated);
        } else {
            BreakingNews::create($validated);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Breaking News diperbarui!');
    }
}