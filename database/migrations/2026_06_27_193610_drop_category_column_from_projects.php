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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('projects');
        });
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('projects')->nullable();
        });
        Schema::table('artworks', function (Blueprint $table) {
            $table->string('projects')->nullable();
        });
    }
};
