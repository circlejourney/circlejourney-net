<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Http\Requests\TextUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::all()->sortDesc();
        return view( "blog.index", ["posts" => $posts] );
    }

    public function create()
    {
        return view("blog.create");
    }


    public function store(TextUpdateRequest $request): RedirectResponse
    {
        $newPost = BlogPost::create(
            [
                "title" => $request->validated()["title"],
                "body" => $request->validated()["body"],
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
        if(!$blogPost->edit_allowed()) {
            return Redirect::back()->withErrors("You do not have permission to edit this post.");
        }
        return view("blog.edit", ["blogPost" => $blogPost]);
    }

    public function update(TextUpdateRequest $request, BlogPost $blogPost)
    {
        if(!$blogPost->edit_allowed()) {
            return Redirect::back()->withErrors("You do not have permission to edit this post.");
        }
        $blogPost->update(
            [
                "title" => $request->validated()["title"],
                "body" => $request->validated()["body"]
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
