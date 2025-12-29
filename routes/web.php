<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MetalinkController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UploadController;
use App\Models\Artwork;
use App\Models\Metalink;
use App\Models\Project;
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

Route::get('/', [ProjectController::class, "welcome"])->name("welcome");

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

    Route::get("/artwork-editor", [ArtworkController::class, "index"])->name("artwork.edit");
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
    $listprojects =  Project::whereHas("categories", function($q) { $q->where("name", "interactive"); })->get();
    return view("interactive", ["projects"=>$listprojects]);
})->name("interactive");

Route::get("/nocturna", function() {
    $listprojects =  Project::whereHas("categories", function($q) { $q->where("name", "nocturna"); })->get();
    $artworks =  Artwork::whereHas("categories", function($q) { $q->where("name", "nocturna"); })->get();
    return view("canonical.nocturna", ["projects"=>$listprojects, "artworks"=>$artworks]);
});


// Art and comics
Route::get('art', [ProjectController::class, "index_art"]);


// Writing
Route::get("/writing", function(){
    $projects = Project::whereHas("categories", function($q) { $q->where("name", "writing"); })->get();
    return view("writing", ["title"=>"Writing", "projects"=>$projects]);
})->name("writing");

Route::get("/writing/portfolio", function(){
    return view("condensed.writing-portfolio");
})->name("writing.portfolio");

Route::get("/offshore", function(){
    $artworks = Artwork::whereHas("categories", function($q) { $q->where("name", "offshore"); })->get();;
    return view("canonical.offshore", ["artworks"=>$artworks]);
});

Route::get("/writing/{page}", function($page) { // Redirect 2-deep writing pages from legacy site links.
    return redirect("/".$page);
});



Route::get('/art/{column},{value}', [ArtworkController::class, "filter"]);

// Collabs
Route::get('/collabs', function(){
    $listprojects =  Project::whereHas("categories", function($q) { $q->where("name", "collabs"); })->get();
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

Route::controller(MusicController::class)->group(function(){
    Route::middleware(['auth', 'auth.admin'])->group(function(){
        Route::get('album-editor', 'index_albums')->name('music.album.index');
        Route::get('album-editor/{album}', 'edit')->name('music.album.edit');
        Route::post('album-editor/{album}', 'update');
        Route::get('album-editor/create', 'create')->name('music.album.create');
        Route::post('album-editor/create', 'store');
    });

    Route::get('music/fanmusic', 'get_fanmusic')->name('music.fanmusic');
});

Route::get("/doodlefisticuffs", function(){
    return view("doodlefisticuffs");
});

Route::get("/thdownload/get.php", function(){
    $thdownloadget = View::make('thdownload.get');
    return response($thdownloadget)->header('Content-type', 'application/json');
});

Route::controller(ResumeController::class)->group(function(){
    Route::get("resume", "show");
});

Route::fallback(function ($e) {
    return redirect( "https://circlejourney.net/".$e );
});