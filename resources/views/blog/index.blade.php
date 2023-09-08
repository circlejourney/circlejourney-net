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
    <div class="spacer"></div>
    @forelse($posts as $post)
        <div class="post-listing">
            <?php $creator = $post->find_creator(); ?>
            <p class="post-text">
                <a href="/blog/{{ $post->id }}">{{ $post->title }}</a>    
            </p>
            <div class="post-meta">
                By <a class="nametag-{{ $creator->rank }}" href="/profile/{{ $creator->id }}">{{ $creator->name }}</a> at {{ $post->created_pretty() }}
            </div>
        </div>
    @empty
        <p class="text-warning">No blog posts available.</p>
    @endforelse

@endsection