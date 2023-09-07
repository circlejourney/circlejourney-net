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
        if(Auth::user()->rank != "admin") {
            return Redirect::back()->withErrors("You do not have permission to delete projects.");
        }
        $projects = Project::all();
        return view('projects.index', [
            "projects" => $projects
        ]);
    }

    public function create()
    {
        if(Auth::user()->rank != "admin") {
            return Redirect::back()->withErrors("You do not have permission to create projects.");
        }

        return view("projects.create");
    }

    public function store(Request $request) {
        if($request->user()->rank != "admin") {
            return Redirect::back()->withErrors("You do not have permission to create a project.");
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
        return redirect("/project-editor/" . $newLink->item_id);
    }

    public function show(Project $project)
    {
        return $project;
    }
    
    public function edit($item_id)
    {
        if(Auth::user()->rank != "admin") {
            return Redirect::back()->withErrors("You do not have permission to create projects.");
        }
        $project = Project::where("item_id", $item_id)->firstOrFail();
        return view("projects.edit", ["project" => $project]);

        return view("projects.edit");
    }

    public function update(Request $request, $item_id)
    {
        if($request->user()->rank != "admin") {
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
        return redirect("/project-editor/" . $project->item_id);
    }

    public function destroy(Project $project)
    {
        if(Auth::user()->rank != "admin") {
            return Redirect::back()->withErrors("You do not have permission to delete projects.");
        }
        $project->delete();
        return redirect("/project-editor/");
    }
}
