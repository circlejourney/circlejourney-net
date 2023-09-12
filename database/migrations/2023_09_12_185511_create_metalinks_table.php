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
        Schema::create('metalinks', function (Blueprint $table) {
            $table->string("item_id", 255);
            $table->text("href");
            $table->text("img_src");
            $table->text("title");
            $table->text("description");
            $table->text("category");
            $table->timestamp("publish_date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metalinks');
    }
};
