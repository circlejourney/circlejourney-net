@extends("layouts.canonical", ["title"=>$title, "projects"=>$projects])

@section("title"){{ "Art and comics" }}@endsection

@section("head")
    @include("components.lightbox-scripts")
@endsection

<?php
    $lightboxable = $illustrations->concat($animations)->filter(function($artwork) {
        return $artwork->openlightbox;
    });
?>

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

    <?php
        $sequence = 0;
    ?>

    <div class="gallery-title">
        <h2>Illustrations</h2>
    </div>

    <div class="gallery">
        @foreach($illustrations as $illustration)
            <x-gallery-art
                :data-sequence="$illustration->openlightbox ? $sequence++ : false"
                src="{{$illustration->thumb_src}}"
                href="{{$illustration->img_src}}"
                :openlightbox="$illustration->openlightbox">
                <x-slot name="title">
                    {{ $illustration->title }}
                </x-slot>
                <p>{!! $illustration->description !!}</p>
            </x-gallery-art>
        @endforeach
    </div>

    <div class="gallery-title">
        <h2>Animations</h2>
    </div>

    <div class="gallery">
        @foreach($animations as $animation)
            <x-gallery-art
                :data-sequence="$animation->openlightbox ? $sequence++ : false"
                src="{{$animation->thumb_src}}"
                href="{{$animation->img_src}}" :openlightbox="$animation->openlightbox">
                <x-slot name="title">
                    {{ $animation->title }}
                </x-slot>
                <p>{!! $animation->description !!}</p>
            </x-gallery-art>
        @endforeach
    </div>

@endsection