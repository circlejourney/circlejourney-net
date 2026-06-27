<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = json_decode( file_get_contents( resource_path('seeders/projects.json') ), true );
        DB::beginTransaction();
        foreach($projects as $projectData) {
            $projectData["item_id"] = Str::of( $projectData["label_title"] )->lower()->kebab();
            if( Project::where('item_id', $projectData['item_id'])->exists() ) continue;
            $project = Project::create( Arr::only( $projectData, (new Project)->getFillable() ) );
            $project->updateCategories( $projectData['categories'] );
        }
        DB::commit();
    }
}
