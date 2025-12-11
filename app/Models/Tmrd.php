<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tmrd extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'nama',
        'tugas',
        'division',          // Added missing field
        'email',             // Added missing field
        'jenis_kegiatan',
        'judul_kegiatan',
        'tanggal',
        'waktu',
        'tempat',            // Added missing field
        'tujuan',            // Added missing field
        'hasil',             // Added missing field
        'status',
        'dokumentasi'        // Added for file uploads (optional)
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'dokumentasi' => 'array'  // If storing file paths as JSON
    ];

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan jenis kegiatan
     */
    public function scopeByJenisKegiatan($query, $jenisKegiatan)
    {
        return $query->where('jenis_kegiatan', $jenisKegiatan);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nip', 'like', '%' . $search . '%')
                  ->orWhere('judul_kegiatan', 'like', '%' . $search . '%')
                  ->orWhere('jenis_kegiatan', 'like', '%' . $search . '%')
                  ->orWhere('division', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('tempat', 'like', '%' . $search . '%');
        });
    }

    /**
     * Get status text dalam bahasa Indonesia
     */
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Pending',
            'in_progress' => 'Sedang Berlangsung',
            'completed' => 'Selesai'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * Get status color class for UI
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'yellow',
            'in_progress' => 'blue',
            'completed' => 'green'
        ];

        return $colors[$this->status] ?? 'gray';
    }

    /**
     * Get jenis kegiatan text yang user-friendly
     */
    public function getJenisKegiatanTextAttribute()
    {
        $types = [
            'risk_assessment' => 'Risk Assessment',
            'risk_monitoring' => 'Risk Monitoring', 
            'risk_mitigation' => 'Risk Mitigation',
            'safety_inspection' => 'Safety Inspection',
            'hazard_identification' => 'Hazard Identification',
            'incident_investigation' => 'Incident Investigation',
            'training_awareness' => 'Training & Awareness',
            'emergency_drill' => 'Emergency Drill',
            'audit_review' => 'Audit & Review'
        ];

        return $types[$this->jenis_kegiatan] ?? $this->jenis_kegiatan;
    }
}