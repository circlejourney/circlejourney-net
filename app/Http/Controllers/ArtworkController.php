<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\FileUploadService;

class ArtworkController extends Controller
{
    
    protected $fileuploadrules = [ 'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120' ];
    protected $urlrules = [ 'img_src' => 'required', 'thumb_src' => 'required' ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artworks = Artwork::all()->sortByDesc('created_at')->sortBy('order');
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
    public function store(Request $request, FileUploadService $fileUploadService)
    {
        
        if($request->image && $request->fileoption == "upload"){
            $request->validate($this->fileuploadrules);
            $filename = $request->image->getClientOriginalName();
            
            if(!$img_src = $fileUploadService->upload($request->image, "uploads/art", null)){
                return Redirect::back()->withErrors("File " . $filename . " already exists.");
            }
            
            $thumb_src = $fileUploadService->generate_thumbnail(realpath($img_src), "uploads/art", 350);

        } else if($request->fileoption == "url") {
            $request->validate($this->urlrules);
            $img_src=$request->img_src;
            $thumb_src=$request->thumb_src;
        }

        $artwork = Artwork::create([
            "title" => $request->title,
            "description" => $request->description,
            "thumb_src" => $thumb_src,
            "img_src" => $img_src,
            "order" => $request->order,
            "openlightbox" => isset($request->openlightbox) ? "1" : "0"
        ]);
        
        $artwork->updateCategories(preg_split("/,\s*/", $request->category));

        return redirect(route("artwork.edit"));
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
    public function update(Request $request, Artwork $artwork, FileUploadService $fileUploadService)
    {

        if($request->image && $request->fileoption == "upload"){
            $request->validate($this->fileuploadrules);
            $filename = $request->image->getClientOriginalName();
            if( !$img_src = $fileUploadService->upload($request->image, "uploads/art", $artwork->img_src) ) {
                return Redirect::back()->withErrors("File " .$filename. " already exists.");
            }
            
            if( file_exists(realpath($artwork->thumb_src)) ) {
                unlink( realpath($artwork->thumb_src) );
            };

            $thumb_src = $fileUploadService->generate_thumbnail(realpath($img_src), "uploads/art", 350);

        } else {
            $request->validate($this->urlrules);
            $img_src=$request->img_src;
            $thumb_src=$request->thumb_src;
        }

        $artwork->update([
            "title" => $request->title,
            "description" => $request->description,
            "thumb_src" => $thumb_src,
            "img_src" => $img_src,
            "order" => $request->order,
            "openlightbox" => isset($request->openlightbox)
        ]);
        
        $artwork->updateCategories(preg_split("/,\s*/", $request->category));

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
        if( file_exists($artwork->thumb_src) ) {
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
        return Artwork::where($column, "like", $value)->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
    }
}
