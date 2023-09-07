<?php
    use App\Models\BlogPost;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
?>

@extends("layouts.canonical")

@section("breadcrumbs")
    @include("components.breadcrumbs",
        [ "crumbs" => [
            ["href" => "/blog", "title" => "Blog"],
            ["href" => "/blog/".$blogPost->id, "title" => $blogPost->title ]
        ] ]
    )
@endsection

@section("title") {{ $blogPost->title }} @endsection

@section("content")

    {!! $blogPost->body  !!}

    <hr>
    
    <p>
        <?php $creator = BlogPost::findCreator($blogPost->user_id) ?>
        Created by {{ $creator->name }} on {{ BlogPost::prettyDate( $blogPost->created_at ) }}.
        @if($blogPost->created_at != $blogPost->updated_at)
            Updated {{ BlogPost::prettyDate( $blogPost->updated_at ) }}.
        @endif
    </p>

    @if(Auth::id() == $blogPost->user_id)
        <a href="/blog/{{ $blogPost->id }}/edit">Edit post</a>

        <form action="" method="post">
            @method("DELETE")
            @csrf
            <a href="delete" onclick="event.preventDefault(); this.closest('form').submit();">Delete post</a>
        </form>
    @endif

@endsection