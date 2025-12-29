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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('order')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->string('thumbnail_path');
            $table->text('description');
            $table->string('spotify_id', 63)->nullable();
            $table->string('bandcamp_slug', 511)->nullable();
            $table->string('bandcamp_id', 63)->nullable();
            $table->string('youtube_id', 63)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
