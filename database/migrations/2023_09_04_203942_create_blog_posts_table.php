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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id(); // Creates ID field that is also primary key in our table

            $table->text('title');  // Title of our blog post          
            $table->text('body');   // Body of our blog post                  
            $table->text('user_id'); // user_id of our blog post author

            $table->timestamps(); //  Creates two TIMESTAMP fields (created_at & updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
