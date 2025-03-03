@extends("layouts.canonical", ["title"=>$title, "projects"=>$projects])

@section("title"){{ "Art and comics" }}@endsection

@section("head")
    @include("components.lightbox-scripts")
@endsection

@section("content")
    @include("components.lightbox", ["artworks" => $lightboxable])
    <div class="center">
        <x-badge-link href="https://circlejourney.weebly.com">Art and design portfolio</x-badge-link>
        <x-badge-link href="https://circlejourney.carrd.co">Commission sheet</x-badge-link>
        <x-badge-link href="/commform">Commission slot claim form</x-badge-link>
    </div>
    
    <div class="bannergrid">
    @foreach($projects as $project)
        <x-bannerbutton class="bannerbutton-50" :$project />
    @endforeach
    </div>

    <x-gallery title="Illustrations" :artworks="$illustrations" :lightboxable="$lightboxable->pluck('id')" />

    <x-gallery title="Animations" :artworks="$animations" :lightboxable="$lightboxable->pluck('id')" />

@endsection