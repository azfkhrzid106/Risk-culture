<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index()
    {
        try {
            \Log::info("Accessing download page - FileController@index");
            
            $files = File::orderBy('created_at', 'desc')->get();
            
            \Log::info("Files count: " . $files->count());
            
            $filesData = $files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'name' => $file->name,
                    'title' => $file->title ?? $file->name, // ✅ TAMBAH TITLE
                    'filename' => $file->filename,
                    'path' => $file->path,
                    'size' => $file->size,
                    'mime_type' => $file->mime_type,
                    'description' => $file->description ?? '', // ✅ TAMBAH DESCRIPTION
                    'category' => $file->category ?? 'general', // ✅ TAMBAH CATEGORY
                    'created_at' => $file->created_at,
                    'updated_at' => $file->updated_at,
                    'download_count' => $file->download_count ?? 0,
                    'download_url' => route('files.download', $file->id),
                    'readable_size' => $file->readable_file_size
                ];
            });
            
            return Inertia::render('Download', [
                'files' => $filesData,
                'success' => session('success'),
                'error' => session('error')
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error in FileController@index: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return Inertia::render('Download', [
                'files' => [],
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            \Log::info('File upload attempt started');
            \Log::info('Request data:', $request->all());

            $request->validate([
                'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,png,jpg,jpeg|max:10240', // ✅ TAMBAH XLS, XLSX, PPT, PPTX
                'title' => 'required|string|max:255', // ✅ WAJIB TITLE
                'description' => 'nullable|string',
                'category' => 'required|string|in:general,policy,manual,safety' // ✅ VALIDASI CATEGORY
            ]);

            $uploaded = $request->file('file');
            $filename = time() . '_' . $uploaded->getClientOriginalName();

            if (!Storage::disk('public')->exists('files')) {
                Storage::disk('public')->makeDirectory('files');
            }

            $path = $uploaded->storeAs('files', $filename, 'public');

            $file = File::create([
                'name' => $request->input('title'), // ✅ GUNAKAN TITLE SEBAGAI NAME
                'title' => $request->input('title'), // ✅ SIMPAN TITLE
                'filename' => $filename,
                'path' => $path,
                'size' => $uploaded->getSize(),
                'mime_type' => $uploaded->getMimeType(),
                'description' => $request->input('description'), // ✅ SIMPAN DESCRIPTION
                'category' => $request->input('category', 'general'), // ✅ SIMPAN CATEGORY
                'download_count' => 0,
            ]);

            \Log::info('File created successfully:', $file->toArray());

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => true,
                    'message' => 'File berhasil diupload!',
                    'file' => $file
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'File berhasil diupload!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->with('error', 'Validasi gagal!');
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Gagal upload file: ' . $e->getMessage());
        }
    }

    public function dashboard()
    {
        try {
            $files = File::orderBy('created_at', 'desc')->get();
            
            $filesData = $files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'name' => $file->name,
                    'title' => $file->title ?? $file->name, // ✅ PASTIKAN TITLE ADA
                    'filename' => $file->filename,
                    'description' => $file->description ?? '',
                    'category' => $file->category ?? 'general',
                    'path' => $file->path,
                    'size' => $file->size,
                    'file_size' => $file->size, // ✅ ALIAS UNTUK COMPATIBILITY
                    'mime_type' => $file->mime_type,
                    'created_at' => $file->created_at,
                    'updated_at' => $file->updated_at,
                    'download_count' => $file->download_count ?? 0,
                    'download_url' => route('files.download', $file->id)
                ];
            });

            return Inertia::render('Dashboard', [
                'documents' => $filesData,
                'flash' => [
                    'success' => session('success'),
                    'error' => session('error')
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error in dashboard: ' . $e->getMessage());
            
            return Inertia::render('Dashboard', [
                'documents' => [],
                'flash' => [
                    'error' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            \Log::info('File update attempt for ID: ' . $id);
            \Log::info('Request data: ' . json_encode($request->all())); // ✅ PERBAIKAN
            \Log::info('Has file: ' . ($request->hasFile('file') ? 'YES' : 'NO')); // ✅ PERBAIKAN
            
            $file = File::findOrFail($id);
            \Log::info('Found file: ' . json_encode($file->toArray())); // ✅ PERBAIKAN
            
            // ✅ VALIDASI SESUAI FRONTEND
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|in:general,policy,manual,safety',
                'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,png,jpg,jpeg|max:10240',
            ]);
            
            // ✅ UPDATE DATA DASAR
            $file->name = $validated['title'];
            $file->title = $validated['title'];
            $file->description = $validated['description'] ?? '';
            $file->category = $validated['category'];
            
            // ✅ HANDLE FILE UPLOAD JIKA ADA
            if ($request->hasFile('file')) {
                \Log::info('New file uploaded, replacing old one');
                
                // Hapus file lama
                if (Storage::disk('public')->exists($file->path)) {
                    Storage::disk('public')->delete($file->path);
                    \Log::info('Old file deleted: ' . $file->path);
                }
                
                // Upload file baru
                $uploaded = $request->file('file');
                $filename = time() . '_' . $uploaded->getClientOriginalName();
                $path = $uploaded->storeAs('files', $filename, 'public');
                
                // Update file info
                $file->filename = $filename;
                $file->path = $path;
                $file->size = $uploaded->getSize();
                $file->mime_type = $uploaded->getMimeType();
                
                \Log::info('New file saved: ' . $path);
            }
            
            $file->save();
            
            \Log::info('File updated successfully: ' . json_encode($file->toArray())); // ✅ PERBAIKAN
            
            // ✅ RESPONSE SESUAI REQUEST TYPE
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Dokumen berhasil diperbarui!',
                    'file' => $file
                ]);
            }
            
            return redirect()->route('dashboard')->with('success', 'Dokumen berhasil diperbarui!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ' . json_encode($e->errors()));
            
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return back()->withErrors($e->errors())->with('error', 'Validasi gagal!');
            
        } catch (\Exception $e) {
            \Log::error('File update error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal memperbarui dokumen: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        try {
            \Log::info("Download attempt for file ID: " . $id);
            
            $file = File::findOrFail($id);
            \Log::info("File found: " . $file->name . ", Path: " . $file->path);
            
            $fullPath = storage_path('app/public/' . $file->path);
            \Log::info("Full file path: " . $fullPath);
            \Log::info("File exists: " . (file_exists($fullPath) ? 'YES' : 'NO'));
            
            if (!Storage::disk('public')->exists($file->path)) {
                \Log::error("File not found in storage: " . $file->path);
                return back()->with('error', 'File tidak ditemukan di storage.');
            }

            // Increment download count
            $file->increment('download_count');
            \Log::info("Download count incremented for file: " . $file->name);

            $originalName = $file->title ?? $file->name;
            
            // Jika nama file tidak memiliki ekstensi, tambahkan berdasarkan mime_type
            if (!pathinfo($originalName, PATHINFO_EXTENSION)) {
                $extension = $this->getExtensionFromMimeType($file->mime_type);
                if ($extension) {
                    $originalName = $originalName . '.' . $extension;
                }
            }

            $headers = [
                'Content-Type' => $file->mime_type,
                'Content-Disposition' => 'attachment; filename="' . $originalName . '"',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ];

            \Log::info("Download headers: ", $headers);
            \Log::info("Final filename: " . $originalName);

            return Storage::disk('public')->download($file->path, $originalName, $headers);
            
        } catch (\Exception $e) {
            \Log::error('Error downloading file: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Gagal mendownload file: ' . $e->getMessage());
        }
    }

    private function getExtensionFromMimeType($mimeType)
    {
        $mimeToExtension = [
            'application/pdf' => 'pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/zip' => 'zip',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'text/plain' => 'txt',
        ];
        
        return $mimeToExtension[$mimeType] ?? null;
    }

    public function show($id)
    {
        try {
            $file = File::findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $file
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'File tidak ditemukan'
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            \Log::info('Delete file attempt for ID: ' . $id);
            
            $file = File::findOrFail($id);
            
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
                \Log::info('File deleted from storage: ' . $file->path);
            }
            
            $file->delete();
            \Log::info('File record deleted from database');
            
            if (request()->header('referer') && strpos(request()->header('referer'), 'dashboard') !== false) {
                return redirect()->route('dashboard')->with('success', 'File berhasil dihapus!');
            }
            
            return back()->with('success', 'File berhasil dihapus!');
            
        } catch (\Exception $e) {
            \Log::error('Error deleting file: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }

    public function apiIndex()
    {
        try {
            $files = File::orderBy('created_at', 'desc')->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $files
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}