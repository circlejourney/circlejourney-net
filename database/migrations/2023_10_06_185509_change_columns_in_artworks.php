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
            $table->text("title")->nullable()->change();
            $table->text("description")->nullable()->change();
            $table->unsignedInteger("order")->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->text("title")->nullable(false)->change();
            $table->text("description")->nullable(false)->change();
            $table->text("order")->default(null)->change();
        });
    }
};
