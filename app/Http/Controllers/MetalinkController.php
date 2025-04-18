<?php

namespace App\Http\Controllers;

use App\Models\Metalink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MetalinkController extends Controller
{
    /**
     * Display the specified resource.
     */

     public function index() {
        $metalinks = Metalink::all();
        return view("metalink.index", ["metalinks" => $metalinks]);
     }

    public function edit(Metalink $metalink)
    {
        return view("metalink.edit", ["metalink" => $metalink]);
    }

    public function update(Request $request, Metalink $metalink)
    {
        $metalink->update(
            [
                "item_id" => $request->item_id,
                "href" => $request->href,
                "img_src" => $request->img_src,
                "title" => $request->title,
                "category" => $request->category,
                "description" => $request->description,
                "publish_date" => $request->publish_date,
                "track_number" => $request->track_number
            ]
        );
        return redirect("/metalink-editor/".$request->item_id);
    }

    public function create()
    {
        return view("metalink.create");
    }

    public function store(Request $request)
    {
        Metalink::create(
            [
                "item_id" => $request->item_id,
                "href" => $request->href,
                "img_src" => $request->img_src,
                "title" => $request->title,
                "description" => $request->description,
                "category" => $request->category,
                "publish_date" => $request->publish_date,
                "track_number" => $request->track_number
            ]
        );
        return redirect("/metalink-editor/");
    }

    public function destroy(Metalink $metalink) {
        $metalink->delete();
        return redirect("/metalink-editor/");
    }

    public static function select(array $link_ids) { // pick by an array 
        $metalinks = array_map(
            function($id){
                return Metalink::find("item_id", $id);
            },
            $link_ids
        );
        return $metalinks;
    }

    public static function filterview(string $column, string $value) {
        $metalinks = Metalink::where($column, "like", $value)->orderBy('publish_date', 'desc')->orderBy('track_number', 'desc')->get();
        return view("metalink.index", ["metalinks" => $metalinks]);
    }
}
