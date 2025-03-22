<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    public function welcome() {
        ["compass-2020", "spectralcarta", "atlasofdrifting", "offshore", "theditor", "flyways", "revolvingdoor", "in-between"];
        $projects = Project::whereHas("categories", function($q){
            return $q->where("name", "highlight");
        });
        return view("welcome", ["projects" => $projects]);
    }

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
        DB::beginTransaction();
        $project = Project::create(
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
        
        $project->updateCategories(preg_split("/,\s*/", $request->category));
        DB::commit();

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
        DB::beginTransaction();
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
        $project->updateCategories(preg_split("/,\s*/", $request->category));
        DB::commit();
        return redirect("/project-editor/".$item_id);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect("/project-editor/");
    }

    public static function select(array $project_ids) {
        $projects = Project::whereIn("id", $project_ids)->get();
        
        return $projects;
    }

    public static function filter(string $column, string $value) {
        return Project::where($column, "like", $value)->orderBy('order', 'desc')->orderBy('created_at', 'asc')->get();
    }

    public function index_art() {
        $artprojects = Project::whereHas("categories", function($q) {
            $q->where("name", "art");
        })->get();
        $illustrations = Artwork::whereHas("categories", function($q) {
            $q->where("name", "illustration");
        })->get();
        $animations = Artwork::whereHas("categories", function($q) {
            $q->where("name", "animation");
        })->get();
        $lightboxable = $illustrations->concat($animations)->where("openlightbox", 1);
        return view("art", ["title"=>"Art and comics", "projects"=>$artprojects, "illustrations"=>$illustrations, "animations"=>$animations, "lightboxable" => $lightboxable]);
    }
}
