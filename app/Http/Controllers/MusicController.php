<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Metalink;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function get_fanmusic() {    
        $homestucklinks = Metalink::where("category", "homestuck")->orderBy("publish_date", "desc")->get();
        $sulinks = Metalink::where("category", "stevenuniverse")->orderBy("publish_date", "desc")->get();
        $otherlinks = Metalink::where("category", "others")->orderBy("publish_date", "desc")->get();
        $vasterrorlinks = Metalink::where("category", "vasterror")->orderBy("publish_date", "desc")->get();
        return view("music.fanmusic", [
            "homestucklinks" => $homestucklinks,
            "vasterrorlinks" => $vasterrorlinks,
            "sulinks" => $sulinks,
            "otherlinks" => $otherlinks
        ]);
    }

    public function create() {
        return view('music.create');
    }

    public function store(Request $request) {
        $album = Album::create($request->only( (new Album)->getFillable() ));
        return redirect()->route('music.album.edit', ['album' => $album]);
    }

    public function index_albums() {
        return view('music.index-albums', ['albums' => Album::orderBy('order', 'desc')->get()]);
    }

    public function edit(Album $album) {
        return view('music.edit', ['album' => $album]);
    }

    public function update(Album $album, Request $request) {
        $album->update( $request->only( (new Album)->getFillable() ) );
        return redirect()->route('music.album.edit', ['album' => $album]);
    }
}
