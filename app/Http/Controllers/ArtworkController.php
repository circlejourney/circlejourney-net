<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArtworkController extends Controller
{
    
    protected $fileuploadrules = [ 'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120' ];
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
            
            if(!$img_src = "/" . $this->upload($request->image, "uploads/art", null)){
                return Redirect::back()->withErrors("File " .$filename. " already exists.");
            }
            
            $thumb_src = "/" . $this->generate_thumbnail(realpath("uploads/art/".$filename), "uploads/art");

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
            "order" => $request->order,
            "openlightbox" => isset($request->openlightbox) ? "1" : "0"
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
            $old_path = substr($artwork->img_src, 1);
            if( !$img_src = $this->upload($request->image, "uploads/art", $old_path) ) {
                return Redirect::back()->withErrors("File " .$filename. " already exists.");
            }

            $img_src = "/" . $img_src;
            
            $thumbpathtrim = substr($artwork->thumb_src,1);
            if( file_exists(realpath($thumbpathtrim)) ) {
                unlink( realpath($thumbpathtrim) );
            };

            $thumb_src = "/" . $this->generate_thumbnail(realpath("uploads/art/".$filename), "uploads/art");

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
            "order" => $request->order,
            "openlightbox" => isset($request->openlightbox) ? "1" : "0"
        ]);
        return redirect("/artwork-editor/" . $artwork->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artwork $artwork)
    {
        $imgpathtrim = substr($artwork->img_src,1);
        $thumbpathtrim = substr($artwork->thumb_src,1);
        if( file_exists(realpath($imgpathtrim)) ) {
            unlink( realpath($imgpathtrim) );
        };
        if( file_exists($thumbpathtrim) ) {
            unlink( realpath($thumbpathtrim) );
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

    protected function upload($file, $target_folder, $old_path) {
        $filename = $file->getClientOriginalName();
        $target_path = $target_folder . "/" . $filename;

        if( file_exists(realpath($target_path)) && $target_path !== $old_path ) {
            return false;
        }
        
        if( file_exists(realpath($old_path)) && $old_path !== null ) {
            unlink( realpath($old_path) );
        };
        
        if( file_exists(realpath($target_path)) ) {
            unlink( realpath($target_path) );
        };

        $file->move(public_path($target_folder), $filename);
        return $target_path;
    }

    protected function generate_thumbnail($src_filepath, $target_folder) {
        $imagesize = getimagesize($src_filepath);
        $hwratio = $imagesize[1] / $imagesize[0];
        $scaleH = $imagesize[1] > $imagesize[0] ? 300 : 300 * $hwratio;
        $scaleW = $imagesize[0] > $imagesize[1] ? 300 : 300 / $hwratio;
        preg_match("/([^\/\\\]+)\.[A_Za-z]{3,4}$/", $src_filepath, $matches);
        $filename = $matches[1]."_thumb.png";

        $format = explode("/", $imagesize["mime"])[1];
        $imagecreatefunc = "imagecreatefrom".$format;
        
        $source_image_blob = $imagecreatefunc($src_filepath);
        $destination_image_blob = imagecreatetruecolor($scaleW, $scaleH);
        $clear = imagecolorallocatealpha($destination_image_blob, 0, 0, 0, 127);
        imagefilledrectangle($destination_image_blob, 0, 0, $scaleW, $scaleH, $clear);
        imagecolortransparent($destination_image_blob, $clear);
        
        imagecopyresampled( $destination_image_blob, $source_image_blob,
            0, 0,
            0, 0,
            $scaleW, $scaleH,
            $imagesize[0], $imagesize[1]
        );
        $target_path = $target_folder . "/" . $filename;

        imagepng($destination_image_blob, $target_path);
        
        return $target_path;
    }
}
