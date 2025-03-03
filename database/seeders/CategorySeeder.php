<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        foreach(Project::all() as $project) {
            $categories = preg_split("/,\s?/", $project->category);
            foreach($categories as $category_name) {
                if(!$category = Category::where("name", $category_name)->first()) {
                    $category = Category::create([
                        "name" => $category_name
                    ]);
                }
                $project->categories()->syncWithoutDetaching($category->id);
            }
        }
        foreach(Artwork::all() as $artwork) {
            $categories = preg_split("/,\s*/", $artwork->category);
            foreach($categories as $category_name) {
                if(!$category = Category::where("name", $category_name)->first()) {
                    $category = Category::create([
                        "name" => $category_name
                    ]);
                }
                $artwork->categories()->syncWithoutDetaching($category->id);
            }
        }

        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn("category");
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn("category");
        });

        DB::commit();
    }
}
