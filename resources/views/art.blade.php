@extends("layouts.projects", ["title"=>$title, "projects"=>$projects])

@section("head")
    @include("components.lightbox-scripts")
    <script>
        $(document).ready(function(){
            $(".gallery-image > a").each(function(i, elt){
                if($(elt).data("sequence") !== undefined) {
                    $(elt).on("click", (e)=>{
                        e.preventDefault();
                        lightbox.show(this.dataset.sequence);
                    });
                }
            });
        })
    </script>
@endsection

<?php
    $lightboxable = $illustrations->concat($animations)->filter(function($artwork) {
        return $artwork->openlightbox;
    });
?>

@section("top")
    @include("components.lightbox", ["artworks" => $lightboxable])
    <div class="center">
        <x-badge-link href="https://circlejourney.weebly.com">Art and design portfolio</x-badge-link>
        <x-badge-link href="https://circlejourney.carrd.co">Commission sheet</x-badge-link>
        <x-badge-link href="/commform">Commission slot claim form</x-badge-link>
    </div>
@endsection

@section("bottom")
    <?php
        $sequence = 0;
    ?>

    <div class="gallery-title">
        <h2>Illustrations</h2>
    </div>

    <div class="subgallery">
        @foreach($illustrations as $illustration)
            <x-gallery-art
                :data-sequence="$illustration->openlightbox ? $sequence++ : false"
                src="{{$illustration->thumb_src}}"
                href="{{$illustration->img_src}}"
                :openlightbox="$illustration->openlightbox">
                <h2 class="caption-title">{{ $illustration->title }}</h2>
                <p>{!! $illustration->description !!}</p>
            </x-gallery-art>
        @endforeach
    </div>

    <div class="gallery-title">
        <h2>Animations</h2>
    </div>

    <div class="subgallery">
        @foreach($animations as $animation)
            <x-gallery-art
                :data-sequence="$animation->openlightbox ? $sequence++ : false"
                src="{{$animation->thumb_src}}"
                href="{{$animation->img_src}}" :openlightbox="$animation->openlightbox">
                <h2 class="caption-title">{{ $animation->title }}</h2>
                <p>{!! $animation->description !!}</p>
            </x-gallery-art>
        @endforeach
    </div>

@endsection