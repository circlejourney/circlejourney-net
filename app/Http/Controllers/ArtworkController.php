<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArtworkController extends Controller
{
    
    protected $fileuploadrules = [ 'image' => 'image|mimes:jpg,png,jpeg,gif' ];
    protected $urlrules = [ 'img_src' => 'required', 'thumb_src' => 'required' ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artworks = Artwork::all()->sortDesc();
        return view('artworks.index', [
            "artworks" => $artworks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("artworks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        if($request->image && $request->fileoption == "upload"){
            $request->validate($this->fileuploadrules);
            $filename = $request->image->getClientOriginalName();
            
            /*$request->image->move(public_path('art/images'), $filename);
            $img_src = "/art/images/".$filename;
            $thumb_src = $img_src;*/
            if(!$img_src = $this->upload($request->image, "art/images", null)){
                return Redirect::back()->withErrors("File " .$filename. " already exists.");
            }
            $thumb_src = $img_src;

        } else if($request->fileoption == "url") {
            $request->validate($this->urlrules);
            $img_src=$request->img_src;
            $thumb_src=$request->thumb_src;
        }

        $create = Artwork::create([
            "title" => $request->title,
            "description" => $request->description,
            "thumb_src" => $thumb_src,
            "img_src" => $img_src,
            "category" => $request->category,
            "order" => $request->order
        ]);

        return redirect("/artwork-editor/");
    }

    /**
     * Display the specified resource.
     */
    public function show(Artwork $artwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artwork $artwork)
    {
        return view("artworks.edit", ["artwork" => $artwork]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artwork $artwork)
    {

        if($request->image && $request->fileoption == "upload"){
            $request->validate($this->fileuploadrules);
            $filename = $request->image->getClientOriginalName();

            /*if( file_exists(realpath("art/images/" . $filename)) && $artwork->img_src !== "/art/images/" . $filename ) {
                return Redirect::back()->withErrors("File " .$filename. " already exists.");
            } else {
                if( file_exists(realpath($artwork->img_src)) ) {
                    unlink( realpath($artwork->img_src) );
                };
                if( file_exists(realpath($artwork->thumb_src)) ) {
                    unlink( realpath($artwork->thumb_src) );
                };
            }

            $request->image->move(public_path('art/images'), $filename);
            $img_src = "/art/images/".$filename;
            $thumb_src = $img_src;*/
            preg_match("/\/([^\/]*)$/", $artwork->img_src, $old_path);
            $old_filename = $old_path[1];
            if( !$img_src = $this->upload($request->image, "art/images", $old_filename) ) {
                return Redirect::back()->withErrors("File " .$filename. " already exists.");
            }
            $thumb_src = $img_src;

        } else if($request->fileoption == "url") {
            $request->validate($this->urlrules);
            $img_src=$request->img_src;
            $thumb_src=$request->thumb_src;
        }

        $artwork -> update([
            "title" => $request->title,
            "description" => $request->description,
            "thumb_src" => $thumb_src,
            "img_src" => $img_src,
            "category" => $request->category,
            "order" => $request->order
        ]);
        return redirect("/artwork-editor/" . $artwork->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artwork $artwork)
    {
        if( file_exists(realpath($artwork->img_src)) ) {
            unlink( realpath($artwork->img_src) );
        };
        if( file_exists(realpath($artwork->thumb_src)) ) {
            unlink( realpath($artwork->thumb_src) );
        };

        $artwork->delete();
        return redirect("/artwork-editor/");
    }

    public static function select(array $artwork_ids) {
        $artworks = array_map(
            function($artwork_ids){
                return Artwork::where("item_id", $artwork_ids)->firstOrFail();
            },
            $artwork_ids
        );
        return $artworks;
    }

    public static function filter(string $column, string $value) {
        return Artwork::where($column, "like", $value)->orderBy('order', 'desc')->orderBy('created_at', 'desc')->get();
    }

    public function upload($file, $target_folder, $old_filename) {
        $filename = $file->getClientOriginalName();
        $target_path = $target_folder . "/" . $filename;

        if( file_exists(realpath($target_path)) && $old_filename !== null && $filename !== $old_filename) {
            return false;
        }
        
        if( file_exists(realpath($target_path)) ) {
            unlink( realpath($target_path) );
        };

        $file->move(public_path($target_folder), $filename);
        return "/" . $target_path;
    }
}
