<?php

namespace App\Http\Controllers;

use App\Models\Tmrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TmrdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tmrd::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('jenis_kegiatan')) {
            $query->byJenisKegiatan($request->jenis_kegiatan);
        }

        $tmrdItems = $query->orderBy('created_at', 'desc')->get();

        return Inertia::render('Tmrd/Index', [
            'tmrdItems' => $tmrdItems,
            'filters' => $request->only(['search', 'status', 'jenis_kegiatan'])
        ]);
    }

    /**
     * PUBLIC SUBMISSION - Handle form dari user (tanpa auth)
     */
    public function submitPublic(Request $request)
    {
        try {
            // Validate input sesuai dengan field dari form Vue.js
            $validated = $request->validate([
                'nip'            => 'required|string|digits_between:8,10',
                'nama'           => 'required|string|max:255',
                'tugas'          => 'required|string|max:255',
                'division'       => 'required|string|max:255', // Field ini ada di form tapi tidak di controller lama
                'email'          => 'required|email|max:255', // Field ini ada di form tapi tidak di controller lama
                'jenis_kegiatan' => 'required|string|in:risk_assessment,risk_monitoring,risk_mitigation,safety_inspection,hazard_identification,incident_investigation,training_awareness,emergency_drill,audit_review',
                'judul_kegiatan' => 'required|string|max:500',
                'tanggal'        => 'required|date',
                'waktu'          => 'required|string',
                'tempat'         => 'required|string|max:255', // Field ini ada di form tapi tidak di controller lama
                'tujuan'         => 'required|string', // Field ini ada di form tapi tidak di controller lama
                'hasil'          => 'required|string', // Field ini ada di form tapi tidak di controller lama
                'status'         => 'sometimes|string|in:pending,in_progress,completed',
                'dokumentasi.*'  => 'sometimes|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240' // 10MB max
            ]);

            // Set default status jika tidak ada
            if (!isset($validated['status'])) {
                $validated['status'] = 'pending';
            }

            // Simpan ke database
            $tmrd = Tmrd::create($validated);

            // Handle file uploads jika ada
            if ($request->hasFile('dokumentasi')) {
                $uploadedFiles = [];
                foreach ($request->file('dokumentasi') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('tmrd_documents', $filename, 'public');
                    $uploadedFiles[] = $path;
                }
                
                // Update record dengan file paths (jika Anda ingin simpan file paths di database)
                // $tmrd->update(['dokumentasi' => json_encode($uploadedFiles)]);
            }

            return response()->json([
                'success' => true,
                'message' => 'TMRD berhasil disubmit! Data akan diproses oleh admin.',
                'data' => $tmrd
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid. Mohon periksa kembali.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('TMRD submission error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ADMIN STORE - Store a newly created resource in storage (admin only)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'            => 'required|string|digits_between:8,10',
            'nama'           => 'required|string|max:255',
            'tugas'          => 'required|string|max:255',
            'division'       => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'jenis_kegiatan' => 'required|string|in:risk_assessment,risk_monitoring,risk_mitigation,safety_inspection,hazard_identification,incident_investigation,training_awareness,emergency_drill,audit_review',
            'judul_kegiatan' => 'required|string|max:500',
            'tanggal'        => 'required|date',
            'waktu'          => 'required|string',
            'tempat'         => 'required|string|max:255',
            'tujuan'         => 'required|string',
            'hasil'          => 'required|string',
            'status'         => 'sometimes|string|in:pending,in_progress,completed'
        ]);

        if (!isset($validated['status'])) {
            $validated['status'] = 'pending';
        }

        Tmrd::create($validated);

        return redirect()->route('tmrd.index')
            ->with('success', 'TMRD berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tmrd $tmrd)
    {
        return response()->json([
            'success' => true,
            'data' => $tmrd
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tmrd $tmrd)
    {
        $validated = $request->validate([
            'nip'            => 'required|string|digits_between:8,10',
            'nama'           => 'required|string|max:255',
            'tugas'          => 'required|string|max:255',
            'division'       => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'jenis_kegiatan' => 'required|string|in:risk_assessment,risk_monitoring,risk_mitigation,safety_inspection,hazard_identification,incident_investigation,training_awareness,emergency_drill,audit_review',
            'judul_kegiatan' => 'required|string|max:500',
            'tanggal'        => 'required|date',
            'waktu'          => 'required|string',
            'tempat'         => 'required|string|max:255',
            'tujuan'         => 'required|string',
            'hasil'          => 'required|string',
            'status'         => 'sometimes|string|in:pending,in_progress,completed'
        ]);

        $tmrd->update($validated);

        return redirect()->route('tmrd.index')
            ->with('success', 'TMRD berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tmrd $tmrd)
    {
        $tmrd->delete();

        return redirect()->route('tmrd.index')
            ->with('success', 'TMRD berhasil dihapus!');
    }

    /**
     * Get statistics for dashboard
     */
    public function getStats()
    {
        $totalTmrd = Tmrd::count();
        $pendingTmrd = Tmrd::where('status', 'pending')->count();
        $inProgressTmrd = Tmrd::where('status', 'in_progress')->count();
        $completedTmrd = Tmrd::where('status', 'completed')->count();

        $jenisKegiatanStats = Tmrd::selectRaw('jenis_kegiatan, count(*) as count')
            ->groupBy('jenis_kegiatan')
            ->pluck('count', 'jenis_kegiatan')
            ->toArray();

        $uniqueEmployees = Tmrd::distinct('nip')->count('nip');

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $totalTmrd,
                'pending' => $pendingTmrd,
                'in_progress' => $inProgressTmrd,
                'completed' => $completedTmrd,
                'jenis_kegiatan' => $jenisKegiatanStats,
                'unique_employees' => $uniqueEmployees
            ]
        ]);
    }
}