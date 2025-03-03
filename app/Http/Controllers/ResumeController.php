<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function show() {
        $artworks = Artwork::whereHas("categories", function($q){
            $q->where("name", "resume_cjnet");
        })->get();
        $bfa = Artwork::whereHas("categories", function($q){
            $q->where("name", "resume_bfa");
        })->get();
        $mfa = Artwork::whereHas("categories", function($q){
            $q->where("name", "resume_mfa");
        })->get();
        $chickenpet = Artwork::whereHas("categories", function($q){
            $q->where("name", "resume_chp");
        })->get();
        $lightboxable = $artworks->concat($bfa)->concat($mfa)->concat($chickenpet)->where("openlightbox", 1);
        error_log($lightboxable->count());
        return view("resume.show", ["artworks" => $artworks, "chickenpet" => $chickenpet, "bfa" => $bfa, "mfa" => $mfa, "lightboxable" => $lightboxable]);
    }
}
