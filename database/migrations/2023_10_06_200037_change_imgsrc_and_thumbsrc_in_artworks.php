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
        Schema::table('artworks', function (Blueprint $table) {
            $table->text("img_src")->default("/images/logosmall.png")->change();
            $table->text("thumb_src")->default("/images/logosmall.png")->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->text("img_src")->default(null)->change();
            $table->text("thumb_src")->default(null)->change();
        });
    }
};
