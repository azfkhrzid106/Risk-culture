<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $newsFile = 'news.json';
    protected $breakingNewsFile = 'breaking_news.json';

    /**
     * Dashboard Admin
     */
    public function dashboard(Request $request)
    {
        $newsItems = $this->getNewsItems();

        // Pagination Manual
        $perPage = 5;
        $currentPage = max((int) $request->get('page', 1), 1);
        $totalItems = count($newsItems);
        $offset = ($currentPage - 1) * $perPage;
        $pagedItems = array_slice($newsItems, $offset, $perPage);

        $pagination = [
            'total' => $totalItems,
            'per_page' => $perPage,
            'current_page' => $currentPage,
            'last_page' => ceil($totalItems / $perPage),
        ];

        return Inertia::render('Dashboard', [
            'newsItems' => $pagedItems,
            'pagination' => $pagination,
            'breakingNews' => $this->getBreakingNews(),
        ]);
    }

    /**
     * Ambil semua berita
     */
    public function getNewsItems()
    {
        if (Storage::exists($this->newsFile)) {
            $content = Storage::get($this->newsFile);
            return json_decode($content, true) ?? [];
        }
        return [];
    }

    /**
     * Ambil Breaking News
     */
    public function getBreakingNews()
    {
        if (Storage::exists($this->breakingNewsFile)) {
            $content = Storage::get($this->breakingNewsFile);
            return json_decode($content, true) ?? ['title' => '', 'isActive' => false];
        }
        return ['title' => '', 'isActive' => false];
    }

    /**
     * Simpan berita baru
     */
    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:info,safety,announcement,event',
            'isActive' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $newsItems = $this->getNewsItems();

        // Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news-images', 'public');
        }

        $newNews = [
            'id' => time(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'isActive' => $request->boolean('isActive', true),
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null,
            'createdAt' => now()->toISOString(),
            'updatedAt' => now()->toISOString(),
        ];

        array_unshift($newsItems, $newNews);
        Storage::put($this->newsFile, json_encode($newsItems));

        return response()->json([
            'success' => true,
            'message' => 'News item created successfully',
            'data' => $newNews
        ]);
    }

    /**
     * Update berita
     */
    public function updateNews(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:info,safety,announcement,event',
            'isActive' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $newsItems = $this->getNewsItems();
        $index = array_search($id, array_column($newsItems, 'id'));

        if ($index === false) {
            return response()->json(['error' => 'News item not found'], 404);
        }

        // Update data
        $newsItems[$index]['title'] = $request->title;
        $newsItems[$index]['content'] = $request->content;
        $newsItems[$index]['category'] = $request->category;
        $newsItems[$index]['isActive'] = $request->boolean('isActive', true);
        $newsItems[$index]['updatedAt'] = now()->toISOString();

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (!empty($newsItems[$index]['image_url'])) {
                $oldPath = str_replace(asset('storage') . '/', '', $newsItems[$index]['image_url']);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('news-images', 'public');
            $newsItems[$index]['image_url'] = asset('storage/' . $imagePath);
        }

        Storage::put($this->newsFile, json_encode($newsItems));

        return response()->json([
            'success' => true,
            'message' => 'News item updated successfully',
            'data' => $newsItems[$index]
        ]);
    }

    /**
     * Hapus berita
     */
    public function deleteNews($id)
    {
        $newsItems = $this->getNewsItems();
        $newList = [];

        foreach ($newsItems as $item) {
            if ($item['id'] == $id) {
                // Hapus gambar jika ada
                if (!empty($item['image_url'])) {
                    $oldPath = str_replace(asset('storage') . '/', '', $item['image_url']);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            } else {
                $newList[] = $item;
            }
        }

        Storage::put($this->newsFile, json_encode($newList));

        return response()->json([
            'success' => true,
            'message' => 'News item deleted successfully'
        ]);
    }

    /**
     * Update Breaking News
     */
    public function updateBreakingNews(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'isActive' => 'boolean'
        ]);

        $breakingNews = [
            'title' => $request->title ?? '',
            'isActive' => $request->boolean('isActive', false),
            'updatedAt' => now()->toISOString(),
        ];

        Storage::put($this->breakingNewsFile, json_encode($breakingNews));

        return response()->json([
            'success' => true,
            'message' => 'Breaking news updated successfully',
            'data' => $breakingNews
        ]);
    }
}
