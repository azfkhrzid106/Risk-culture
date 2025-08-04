<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $newsFile = 'news.json';
    protected $breakingNewsFile = 'breaking_news.json';

    public function dashboard()
    {
        // Check if user is authenticated (you can implement proper auth later)
        return Inertia::render('Dashboard', [
            'newsItems' => $this->getNewsItems(),
            'breakingNews' => $this->getBreakingNews(),
        ]);
    }

    public function getNewsItems()
    {
        if (Storage::exists($this->newsFile)) {
            $content = Storage::get($this->newsFile);
            return json_decode($content, true) ?? [];
        }
        return [];
    }

    public function getBreakingNews()
    {
        if (Storage::exists($this->breakingNewsFile)) {
            $content = Storage::get($this->breakingNewsFile);
            return json_decode($content, true) ?? ['title' => '', 'isActive' => false];
        }
        return ['title' => '', 'isActive' => false];
    }

    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:info,safety,announcement,event',
            'isActive' => 'boolean'
        ]);

        $newsItems = $this->getNewsItems();
        
        $newNews = [
            'id' => time(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'isActive' => $request->boolean('isActive', true),
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

    public function updateNews(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:info,safety,announcement,event',
            'isActive' => 'boolean'
        ]);

        $newsItems = $this->getNewsItems();
        $index = array_search($id, array_column($newsItems, 'id'));

        if ($index === false) {
            return response()->json(['error' => 'News item not found'], 404);
        }

        $newsItems[$index] = array_merge($newsItems[$index], [
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'isActive' => $request->boolean('isActive', true),
            'updatedAt' => now()->toISOString(),
        ]);

        Storage::put($this->newsFile, json_encode($newsItems));

        return response()->json([
            'success' => true,
            'message' => 'News item updated successfully',
            'data' => $newsItems[$index]
        ]);
    }

    public function deleteNews($id)
    {
        $newsItems = $this->getNewsItems();
        $newsItems = array_filter($newsItems, function($item) use ($id) {
            return $item['id'] != $id;
        });

        Storage::put($this->newsFile, json_encode(array_values($newsItems)));

        return response()->json([
            'success' => true,
            'message' => 'News item deleted successfully'
        ]);
    }

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

// app/Http/Controllers/PublicController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PublicController extends Controller
{
    protected $newsFile = 'news.json';
    protected $breakingNewsFile = 'breaking_news.json';

    public function welcome()
    {
        return Inertia::render('Welcome', [
            'newsItems' => $this->getActiveNews(),
            'breakingNews' => $this->getBreakingNews(),
        ]);
    }

    public function getActiveNews()
    {
        if (Storage::exists($this->newsFile)) {
            $content = Storage::get($this->newsFile);
            $newsItems = json_decode($content, true) ?? [];
            
            // Filter only active news and sort by creation date
            $activeNews = array_filter($newsItems, function($item) {
                return $item['isActive'] ?? false;
            });

            // Sort by creation date (newest first)
            usort($activeNews, function($a, $b) {
                return strtotime($b['createdAt']) - strtotime($a['createdAt']);
            });

            return array_values($activeNews);
        }
        return [];
    }

    public function getBreakingNews()
    {
        if (Storage::exists($this->breakingNewsFile)) {
            $content = Storage::get($this->breakingNewsFile);
            $breakingNews = json_decode($content, true);
            
            // Only return if active
            if ($breakingNews && ($breakingNews['isActive'] ?? false)) {
                return $breakingNews;
            }
        }
        return ['title' => '', 'isActive' => false];
    }

    public function getNewsApi()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'newsItems' => $this->getActiveNews(),
                'breakingNews' => $this->getBreakingNews(),
            ]
        ]);
    }
}

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Simple hardcoded admin credentials (you should use proper authentication)
        $adminEmail = 'admin@k3inalum.com';
        $adminPassword = 'admin123';

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            // Create session
            session(['admin_logged_in' => true]);
            session(['admin_email' => $request->email]);

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => '/dashboard'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_email']);
        return redirect('/');
    }
}

// app/Http/Middleware/AdminAuth.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in')) {
            return redirect('/login');
        }

        return $next($request);
    }
}

// routes/web.php
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/api/news', [PublicController::class, 'getNewsApi'])->name('api.news');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // News management API
    Route::post('/admin/news', [AdminController::class, 'storeNews'])->name('admin.news.store');
    Route::put('/admin/news/{id}', [AdminController::class, 'updateNews'])->name('admin.news.update');
    Route::delete('/admin/news/{id}', [AdminController::class, 'deleteNews'])->name('admin.news.delete');
    
    // Breaking news
    Route::put('/admin/breaking-news', [AdminController::class, 'updateBreakingNews'])->name('admin.breaking.update');
});

// Register middleware in app/Http/Kernel.php
// Add to $routeMiddleware array:
// 'admin.auth' => \App\Http\Middleware\AdminAuth::class,