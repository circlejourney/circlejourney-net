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
        <x-gallery-art id="image-{{ $artwork->id }}" href="/artwork-editor/{{ $artwork->id }}" src="/{{$artwork->thumb_src}}">
            <h2 class="caption-title">{{ $artwork->title }}</h2>
            <p>{!! $artwork->description !!}</p>
        </x-gallery-art>
    @endforeach
</div>
@endsection