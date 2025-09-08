<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('breaking_news', function (Blueprint $table) {
        $table->string('title')->nullable(); // Atau sesuaikan tipe datanya
    });
}

public function down()
{
    Schema::table('breaking_news', function (Blueprint $table) {
        $table->dropColumn('title');
    });
}
};
