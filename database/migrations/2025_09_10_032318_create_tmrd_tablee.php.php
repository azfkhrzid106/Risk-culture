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
        Schema::create('tmrds', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20); // NIP Pegawai
            $table->string('nama', 255); // Nama Pegawai
            $table->string('tugas', 255); // Tugas/Jabatan
            $table->enum('jenis_kegiatan', [
                'Safety Meeting',
                'Risk Assessment', 
                'Training',
                'Audit',
                'Inspeksi',
                'Investigation',
                'Lainnya'
            ]); // Jenis Kegiatan
            $table->text('judul_kegiatan'); // Judul/Deskripsi Kegiatan
            $table->date('tanggal'); // Tanggal Kegiatan
            $table->time('waktu'); // Waktu Kegiatan
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending'); // Status
            $table->timestamps();

            // Indexes untuk optimasi query
            $table->index('nip');
            $table->index('status');
            $table->index('jenis_kegiatan');
            $table->index('tanggal');
            $table->index(['status', 'tanggal']); // Composite index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmrds');
    }
};