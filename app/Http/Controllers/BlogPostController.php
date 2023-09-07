<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::all();
        return view( "blog.index", ["posts" => $posts] );
    }

    public function create()
    {
        if(!Auth::check()) {
            return redirect("/login?return=/blog/create");
        }
        return view("blog.create");
    }


    public function store(Request $request)
    {
        if(!Auth::check()) {
            return redirect("/login?return=/blog/create");
        }

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
        if(Auth::id() != $blogPost->user_id) {
            return Redirect::back()->withErrors("You do not have permission to edit this post.");
        }
        return view("blog.edit", ["blogPost" => $blogPost]);
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        if($request->user()->id != $blogPost->user_id) {
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
        $blogPost->delete();
        return redirect("/blog");
    }
}
