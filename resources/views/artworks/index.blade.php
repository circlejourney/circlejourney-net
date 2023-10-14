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

<div class="gallery">
    @foreach($artworks as $artwork)
        <x-gallery-art
            id="image-{{ $artwork->id }}"
            href="/artwork-editor/{{ $artwork->id }}"
            src="{{$artwork->thumb_src}}"
            openlightbox=true
        >
            <x-slot name="title">{{ $artwork->title }}</x-slot>
            <p>{!! $artwork->description !!}</p>
        </x-gallery-art>
    @endforeach
</div>
@endsection