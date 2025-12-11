<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop dan recreate column dengan enum values yang benar
        Schema::table('tmrds', function (Blueprint $table) {
            $table->dropColumn('jenis_kegiatan');
        });

        Schema::table('tmrds', function (Blueprint $table) {
            $table->enum('jenis_kegiatan', [
                'risk_assessment',
                'risk_monitoring', 
                'risk_mitigation',
                'safety_inspection',
                'hazard_identification',
                'incident_investigation',
                'training_awareness',
                'emergency_drill',
                'audit_review'
            ])->after('tugas');
            
            $table->index('jenis_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmrds', function (Blueprint $table) {
            $table->dropColumn('jenis_kegiatan');
        });

        Schema::table('tmrds', function (Blueprint $table) {
            $table->enum('jenis_kegiatan', [
                'Safety Meeting',
                'Risk Assessment', 
                'Training',
                'Audit',
                'Inspeksi',
                'Investigation',
                'Lainnya'
            ])->after('tugas');
        });
    }
};