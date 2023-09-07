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
        if(!Auth::user()) return route("login");
        if(!Auth::user()->hasRank("admin")) {
            return Redirect::back()->withErrors("You do not have permission to edit projects.");
        }
        $projects = Project::all()->sortDesc();
        return view('projects.index', [
            "projects" => $projects
        ]);
    }

    public function create()
    {
        if(!Auth::user()) return route("login");
        if(!Auth::user()->hasRank("admin")) {
            return Redirect::back()->withErrors("You do not have permission to create projects.");
        }

        return view("projects.create");
    }

    public function store(Request $request) {
        if(!Auth::user()) return route("login");
        if(!$request->user()->hasRank("admin")) {
            return Redirect::back()->withErrors("You do not have permission to create projects.");
        }
        $dark = isset($request->dark) ? "1" : "0";
        $newLink = Project::create(
            [
                "item_id" => $request->item_id,
                "href" => $request->href,
                "background_image" => $request->background_image,
                "background_position" => $request->background_position,
                "label_title" => $request->label_title,
                "label_text" => $request->label_text,
                "user_id" => $request->user()->id,
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
        if(!Auth::user()) return route("login");
        if(!Auth::user()->hasRank("admin")) {
            return Redirect::back()->withErrors("You do not have permission to edit projects.");
        }
        $project = Project::where("item_id", $item_id)->firstOrFail();
        return view("projects.edit", ["project" => $project]);
    }

    public function update(Request $request, $item_id)
    {
        if(!Auth::user()) return route("login");
        if(!$request->user()->hasRank("admin")) {
            return Redirect::back()->withErrors("You do not have permission to edit projects.");
        }
        $project = Project::where("item_id", $item_id)->firstOrFail();
        $dark = isset($project->dark) ? "1" : "0";
        $project->update(
            [
                "href" => $request->href,
                "background_image" => $request->background_image,
                "background_position" => $request->background_position,
                "label_title" => $request->label_title,
                "label_text" => $request->label_text,
                "dark" => $dark
            ]
        );
        return redirect("/project-editor/");
    }

    public function destroy(Project $project)
    {
        if(!Auth::user()) return route("login");
        if(!Auth::user()->hasRank("admin")) {
            return Redirect::back()->withErrors("You do not have permission to delete projects.");
        }
        $project->delete();
        return redirect("/project-editor/");
    }

    public static function select(array $project_ids) {
        $projects = array_map(
            function($project_id){
                return Project::where("item_id", $project_id)->firstOrFail();
            },
            $project_ids
        );
        return $projects;
    }
}
