<?php

// ====== MODEL: News.php (Updated) ======

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['title', 'content', 'category', 'is_active', 'image_path'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Accessor untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return Storage::disk('public')->url($this->image_path);
        }
        return null;
    }

    // Scope untuk berita aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
