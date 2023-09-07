@extends("layouts.canonical")
@section("title") Blog @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/blog", "title"=>"Blog"]
        ]
    ])
@endsection

@section("content")
    <p><a href="/blog/create">Create a new post</a></p>
    @forelse($posts as $post)
        <ul>
            <li><a href="/blog/{{ $post->id }}">{{ $post->title }}</a> by {{ $post->user_name }}</li>
        </ul>
    @empty
        <p class="text-warning">No blog posts available</p>
    @endforelse

@endsection