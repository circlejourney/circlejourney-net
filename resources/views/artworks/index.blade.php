@extends("layouts.canonical")

@section("title"){{ "Edit Artwork" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/artwork-editor", "title"=>"Edit artwork"]
        ]
    ])
@endsection

@section("content")
<p class="center">
    <a href="/artwork-editor/create">Create a new artwork</a>
</p>

<div class="subgallery">
    @foreach($artworks as $artwork)
        <x-gallery-art href="/artwork-editor/{{ $artwork->id }}" :src="$artwork->thumb_src">{{ $artwork->title }}</x-gallery-art>
    @endforeach
</div>
@endsection