<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\BreakingNews;
use App\Models\Document; // Tambahkan import ini
use App\Models\Tmrd; // Tambahkan import ini jika ada model TMRD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Tampilkan Dashboard Admin
     */
    public function index()
    {
        $newsItems = News::orderBy('created_at', 'desc')->get()->map(function ($news) {
            return [
                'id' => $news->id,
                'title' => $news->title,
                'content' => $news->content,
                'category' => $news->category,
                'is_active' => $news->is_active,
                'created_at' => $news->created_at,
                'updated_at' => $news->updated_at,
            ];
        });

        // Ambil data documents jika model ada
        $documents = [];
        if (class_exists('App\Models\Document')) {
            $documents = Document::orderBy('created_at', 'desc')->get()->toArray();
        }

        // Ambil data TMRD jika model ada
        $tmrdItems = [];
        if (class_exists('App\Models\Tmrd')) {
            $tmrdItems = Tmrd::orderBy('created_at', 'desc')->get()->toArray();
        }

        // Perbaiki path render - sesuaikan dengan struktur folder Anda
        return Inertia::render('Dashboard', [ // Ubah dari 'Admin/Dashboard' ke 'Dashboard'
            'newsItems' => $newsItems,
            'documents' => $documents,
            'tmrdItems' => $tmrdItems,
            'breakingNews' => BreakingNews::first() ?? ['title' => '', 'is_active' => false]
        ]);
    }

    /**
     * Simpan berita baru
     */
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

        if ($request->hasFile('image')) {
            $filename = time() . '_' . Str::random(8) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image_path'] = $request->file('image')->storeAs('news-images', $filename, 'public');
        }

        News::create($data);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Update berita
     */
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

        if ($request->hasFile('image')) {
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }

            $filename = time() . '_' . Str::random(8) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image_path'] = $request->file('image')->storeAs('news-images', $filename, 'public');
        }

        $news->update($data);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Hapus berita
     */
    public function destroy(News $news)
    {
        if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}