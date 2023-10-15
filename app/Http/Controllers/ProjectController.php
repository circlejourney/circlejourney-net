<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all()->sortDesc();
        return view('projects.index', [
            "projects" => $projects
        ]);
    }

    public function create()
    {
        return view("projects.create");
    }

    public function store(Request $request) {
        $dark = isset($request->dark) ? "1" : "0";
        Project::create(
            [
                "item_id" => $request->item_id,
                "href" => $request->href,
                "background_image" => $request->background_image,
                "background_position" => $request->background_position,
                "label_title" => $request->label_title,
                "label_text" => $request->label_text,
                "category" => $request->category,
                "order" => $request->order,
                "dark" => $dark
            ]
        );
        return redirect("/project-editor/");
    }

    public function show(Project $project)
    {
        return $project;
    }
    
    public function edit($item_id)
    {
        $project = Project::where("item_id", $item_id)->firstOrFail();
        return view("projects.edit", ["project" => $project]);
    }

    public function update(Request $request, $item_id)
    {
        $project = Project::where("item_id", $item_id)->firstOrFail();
        $dark = isset($project->dark) ? "1" : "0";
        $project->update(
            [
                "href" => $request->href,
                "background_image" => $request->background_image,
                "background_position" => $request->background_position,
                "label_title" => $request->label_title,
                "label_text" => $request->label_text,
                "category" => $request->category,
                "order" => $request->order,
                "dark" => $dark
            ]
        );
        return redirect("/project-editor/".$item_id);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect("/project-editor/");
    }

    public static function select(array $project_ids) {
        $projects = array_filter(array_map(function($project_id){
                return Project::where("item_id", $project_id)->first();
            }, $project_ids));
        
        return $projects;
    }

    public static function filter(string $column, string $value) {
        return Project::where($column, "like", $value)->orderBy('order', 'desc')->orderBy('created_at', 'asc')->get();
    }
}
