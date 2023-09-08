<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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
    Route::delete('/project-editor/{project}', [ProjectController::class, "delete"]);
});


// Interactive
Route::get('/interactive', function(){
    return view("interactive", [
        "projects" => ProjectController::select([ "compass-2020", "spectralcarta", "water", "theditor", "in-between", "angel", "islands", "petridish", "ghosts", "swim" ])
    ]);
});


// Collabs
Route::get('/collabs', function(){
    return view("layouts.projects", [
        "title"=>"Collaborations and community projects",
        "projects" => ProjectController::select(["windowtoworlds-2023", "lofam5", "windowtoworlds-2021", "seaunseenzine-2021", "windowtoworlds-2020", "songsfromearth", "wishescursesanddreams", "bowozine", "20personswitcharound", "cdz-2021", "rosemagazine2" ]) ]);
});

Route::get('/links', [\App\Http\Controllers\SocialLinkController::class, 'index']);

// Blog
Route::get("/blog", [BlogPostController::class, "index"]);
//Route::get("/blog", [BlogPostController::class, "index"]);
Route::middleware('auth', 'auth.bio')->group(function () {
    Route::get("/blog/create", [BlogPostController::class, "create"]);
    Route::post("/blog/create", [BlogPostController::class, "store"]);
    Route::get("/blog/{blogPost}/edit", [BlogPostController::class, "edit"]);
    Route::put("/blog/{blogPost}/edit", [BlogPostController::class, "update"]);
    Route::delete("/blog/{blogPost}", [BlogPostController::class, "destroy"]);
});
Route::get("/blog/{blogPost}", [BlogPostController::class, "show"]);


Route::fallback(function ($e) {
    return redirect( "https://circlejourney.net/".$e );
});