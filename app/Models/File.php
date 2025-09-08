<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',          // ✅ TAMBAH INI
        'filename',
        'path',
        'size',
        'mime_type',
        'description',    // ✅ TAMBAH INI
        'category',       // ✅ TAMBAH INI
        'download_count',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'size' => 'integer',
        'download_count' => 'integer'
    ];

    public function getReadableFileSizeAttribute()
    {
        $bytes = $this->size;
        if (!$bytes) return '0 B';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < 3; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}