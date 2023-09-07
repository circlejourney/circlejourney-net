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
        Created by {{ $blogPost->find_creator() }} on {{ $blogPost->created_pretty() }}.
        @if($blogPost->created_at != $blogPost->updated_at)
            Updated {{ $blogPost->updated_pretty() }}.
        @endif
    </p>

    @if($blogPost->edit_allowed())
        <a href="/blog/{{ $blogPost->id }}/edit">Edit post</a>

        <form action="" method="post">
            @method("DELETE")
            @csrf
            <a href="delete" onclick="event.preventDefault(); this.closest('form').submit();">Delete post</a>
        </form>
    @endif

@endsection