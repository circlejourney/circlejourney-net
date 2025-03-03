<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function show() {
        return view("resume.show");
    }
}
