<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\Metalink;
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
        if(Schema::hasColumn('projects', 'category')) {
            foreach(Project::all() as $project) {
                $categories = preg_split("/,\s?/", $project->category);
                $project->updateCategories($categories);
            }
        };
        
        if(Schema::hasColumn('projects', 'category')) {
            foreach(Artwork::all() as $artwork) {
                $categories = preg_split("/,\s*/", $artwork->category);
                $artwork->updateCategories($categories);
            }
        }

        foreach(Metalink::all() as $metalink) {
            $categories = preg_split("/,\s*/", $artwork->category);
            $metalink->updateCategories($categories);
        }

        DB::commit();
    }
}
