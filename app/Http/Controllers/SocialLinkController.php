<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $social_links = SocialLink::all();
        return view("links", ["social_links" => $social_links]);
    }
    
}
