<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BreakingNews;
use Illuminate\Http\Request;

class BreakingNewsController extends Controller
{
    /**
     * Update atau buat Breaking News
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        $breakingNews = BreakingNews::first();
        if ($breakingNews) {
            $breakingNews->update($validated);
        } else {
            BreakingNews::create($validated);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Breaking News berhasil diperbarui!');
    }
}
