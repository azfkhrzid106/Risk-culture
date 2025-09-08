<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->string('title')->nullable()->after('name');
            $table->text('description')->nullable()->after('title');  
            $table->string('category', 50)->default('general')->after('description');
        });
    }

    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'category']);
        });
    }
};