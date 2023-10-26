<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MetalinkController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view("welcome", [
        "projects" => ProjectController::select(["compass-2020", "spectralcarta", "atlasofdrifting", "offshore", "theditor", "flyways", "revolvingdoor", "in-between"], ["alternate"=> true ])
    ]);
})->name("welcome");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/profile/{user_id}", [ProfileController::class, "show"]);
});

require __DIR__.'/auth.php';

// Projects
Route::middleware(['auth', 'auth.admin'])->group(function(){

    Route::get('/project-editor', [ProjectController::class, "index"]);
    Route::get('/project-editor/create', [ProjectController::class, "create"]);
    Route::post('/project-editor/create', [ProjectController::class, "store"]);
    Route::get('/project-editor/{project}', [ProjectController::class, "edit"]);
    Route::put('/project-editor/{project}', [ProjectController::class, "update"]);
    Route::delete('/project-editor/{project}', [ProjectController::class, "destroy"]);

    Route::get("/metalink-editor", [MetalinkController::class, "index"]);
    Route::get('/metalink-editor/create', [MetalinkController::class, "create"]);
    Route::post('/metalink-editor/create', [MetalinkController::class, "store"]);
    Route::get("/metalink-editor/{metalink}", [MetalinkController::class, "edit"]);
    Route::delete("/metalink-editor/{metalink}", [MetalinkController::class, "destroy"]);
    Route::put('/metalink-editor/{metalink}', [MetalinkController::class, "update"]);

    Route::get("/artwork-editor", [ArtworkController::class, "index"]);
    Route::get("/artwork-editor/create", [ArtworkController::class, "create"]);
    Route::post("/artwork-editor/create", [ArtworkController::class, "store"]);
    Route::get("/artwork-editor/{artwork}", [ArtworkController::class, "edit"]);
    Route::delete("/artwork-editor/{artwork}", [ArtworkController::class, "destroy"]);
    Route::put("/artwork-editor/{artwork}", [ArtworkController::class, "update"]);

    Route::get("/upload", [UploadController::class, "index"]);
    Route::post("/upload", [UploadController::class, "store"]);
    Route::delete("/upload/delete/{upload}", [UploadController::class, "destroy"]);
});


// Interactive
Route::get('/interactive', function(){
    $listprojects = ProjectController::filter("category", "%interactive%");
    return view("interactive", ["projects"=>$listprojects]);
});
Route::get("/nocturna", function() {
    $listprojects = ProjectController::filter("category", "%nocturna%");
    $artworks = ArtworkController::filter("category", "%nocturna%");
    return view("canonical.nocturna", ["projects"=>$listprojects, "artworks"=>$artworks]);
});


// Art and comics
Route::get('/art', function(){
    $listprojects = ProjectController::filter("category", "%art%");
    $illustrations = ArtworkController::filter("category", "%illustration%");
    $animations = ArtworkController::filter("category", "%animation%");

    return view("art", ["title"=>"Art and comics", "projects"=>$listprojects, "illustrations"=>$illustrations, "animations"=>$animations]);
});

Route::get("/writing", function(){
    $projects = ProjectController::filter("category", "%writing%");
    return view("layouts.projects", ["title"=>"Writing", "projects"=>$projects]);
});

Route::get("/offshore", function(){
    $artworks = ArtworkController::filter("category", "%offshore%");
    return view("canonical.offshore", ["artworks"=>$artworks]);
});

Route::get("/writing/{page}", function($page) { // Redirect 2-deep writing pages from legacy site links.
    return redirect("/".$page);
});



Route::get('/art/{column},{value}', [ArtworkController::class, "filter"]);

// Collabs
Route::get('/collabs', function(){
    $listprojects = ProjectController::filter("category", "%collabs%");
    return view("layouts.projects", ["title"=>"Collaborations and community projects", "projects"=>$listprojects ]);
});

Route::get('/links', [\App\Http\Controllers\SocialLinkController::class, 'index']);

// Blog
Route::get("/blog", [BlogPostController::class, "index"]);
Route::middleware('auth', 'auth.bio')->group(function () {
    Route::get("/blog/create", [BlogPostController::class, "create"]);
    Route::post("/blog/create", [BlogPostController::class, "store"]);
    Route::get("/blog/{blogPost}/edit", [BlogPostController::class, "edit"]);
    Route::put("/blog/{blogPost}/edit", [BlogPostController::class, "update"]);
    Route::delete("/blog/{blogPost}", [BlogPostController::class, "destroy"]);
});
Route::get("/blog/{blogPost}", [BlogPostController::class, "show"]);

// Music
Route::get("/music", function(){
    return view("music.index");
});
Route::get('/music/{column},{value}', [\App\Http\Controllers\MetalinkController::class, "filterview"]);

Route::get("/music/fanmusic", function(){
    $homestucklinks = MetalinkController::filter("category", "homestuck");
    $vasterrorlinks = MetalinkController::filter("category", "vasterror");
    $sulinks = MetalinkController::filter("category", "stevenuniverse");
    $otherlinks = MetalinkController::filter("category", "others");
    return view("music.fanmusic", [
        "homestucklinks" => $homestucklinks,
        "vasterrorlinks" => $vasterrorlinks,
        "sulinks" => $sulinks,
        "otherlinks" => $otherlinks
    ]);
});

Route::get("/doodlefisticuffs", function(){
    return view("doodlefisticuffs");
});

Route::get("/thdownload", function(){
    return view("thdownload.index");
});

Route::get("/thdownload/get.php", function(){
    $thdownloadget = View::make('thdownload.get');
    return response($thdownloadget)->header('Content-type', 'application/json');
});

Route::fallback(function ($e) {
    return redirect( "https://circlejourney.net/".$e );
});