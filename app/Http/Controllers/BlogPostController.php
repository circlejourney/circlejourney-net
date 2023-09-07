<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::all();
        foreach($posts as $post) {
            $post->user_name = User::where("id", $post->id)->firstOrFail()->name;
        }
        return view( "blog.index", ["posts" => $posts] );
    }

    public function create()
    {
        if(!Auth::check()) return route("login");
        return view("blog.create");
    }


    public function store(Request $request)
    {
        if(!Auth::check()) return route("login");
        $newPost = BlogPost::create(
            [
                "title" => $request->title,
                "body" => $request->body,
                "user_id" => $request->user()->id
            ]
        );
        return redirect("/blog/" . $newPost->id);
    }
    

    public function show(BlogPost $blogPost)
    {
        return view( "blog.show", [ "blogPost" => $blogPost ] );
    }

    public function edit(BlogPost $blogPost)
    {
        if(!Auth::check()) return route("login");
        if(!$blogPost->edit_allowed()) {
            return Redirect::back()->withErrors("You do not have permission to edit this post.");
        }
        //$blogPost->user_name = $blogPost->findCreator();
        return view("blog.edit", ["blogPost" => $blogPost]);
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        if(!Auth::check()) return route("login");
        if(!$blogPost->edit_allowed()) {
            return Redirect::back()->withErrors("You do not have permission to edit this post.");
        }
        $blogPost->update(
            [
                "title" => $request->title,
                "body" => $request->body
            ]
        );
        return redirect("/blog/" . $blogPost->id);
    }

    public function destroy(BlogPost $blogPost)
    {
        if(!$blogPost->edit_allowed()) {
            return Redirect::back()->withErrors("You do not have permission to edit this post.");
        }
        $blogPost->delete();
        return redirect("/blog");
    }
}
