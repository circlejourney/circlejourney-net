<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artwork $artwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artwork $artwork)
    {
        //
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
}
