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
        Schema::table('tmrds', function (Blueprint $table) {
            if (!Schema::hasColumn('tmrds', 'division')) {
                $table->string('division')->nullable()->after('tugas');
            }
            if (!Schema::hasColumn('tmrds', 'email')) {
                $table->string('email')->nullable()->after('division');
            }
            if (!Schema::hasColumn('tmrds', 'tempat')) {
                $table->string('tempat')->nullable()->after('waktu');
            }
            if (!Schema::hasColumn('tmrds', 'tujuan')) {
                $table->text('tujuan')->nullable()->after('tempat');
            }
            if (!Schema::hasColumn('tmrds', 'hasil')) {
                $table->text('hasil')->nullable()->after('tujuan');
            }
            if (!Schema::hasColumn('tmrds', 'dokumentasi')) {
                $table->json('dokumentasi')->nullable()->after('hasil');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmrds', function (Blueprint $table) {
            $table->dropColumn(['division', 'email', 'tempat', 'tujuan', 'hasil', 'dokumentasi']);
        });
    }
};