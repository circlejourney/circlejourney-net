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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Projects
Route::middleware('auth')->group(function(){
    Route::get('/project-editor', [ProjectController::class, "index"]);
    Route::get('/project-editor/create', [ProjectController::class, "create"]);
    Route::post('/project-editor/create', [ProjectController::class, "store"]);
    Route::get('/project-editor/{project}', [ProjectController::class, "edit"]);
    Route::put('/project-editor/{project}', [ProjectController::class, "update"]);
});

Route::get('/collabs', function () {
    return view('collabs');
});

Route::get('/links', [\App\Http\Controllers\SocialLinkController::class, 'index']);

// Blog
Route::get("/blog", [BlogPostController::class, "index"]);
Route::get("/blog/create", [BlogPostController::class, "create"]);
Route::post("/blog/create", [BlogPostController::class, "store"]);
Route::get("/blog/{blogPost}/edit", [BlogPostController::class, "edit"]);
Route::put("/blog/{blogPost}/edit", [BlogPostController::class, "update"]);
Route::get("/blog/{blogPost}", [BlogPostController::class, "show"]);
Route::delete("/blog/{blogPost}", [BlogPostController::class, "destroy"]);