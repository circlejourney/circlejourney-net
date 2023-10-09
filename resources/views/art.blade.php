@extends("layouts.projects", ["title"=>$title, "projects"=>$projects])

@section("head")
    @include("components.lightbox-scripts")
    <script>
        $(document).ready(function(){
            $(".gallery-image").on("click", function(e){
                e.preventDefault();
                lightbox.show(this.dataset.sequence);
            });
        })
    </script>
@endsection


@section("top")
    @include("components.lightbox", ["artworks" => $illustrations->concat($animations)])
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

    <div class="subgallery">
        <div class="gallery-title">
            <h2>Illustrations</h2>
            <div class="click-notice">Click to view full size</div>
        </div>
        @foreach($illustrations as $illustration)
            <x-gallery-art
                :sequence="$sequence++"
                src="/{{$illustration->thumb_src}}"
                href="/{{$illustration->img_src}}"
                :openlightbox="$illustration->openlightbox">
                <h2 class="caption-title">{{ $illustration->title }}</h2>
                <p>{!! $illustration->description !!}</p>
            </x-gallery-art>
        @endforeach
    </div>

    <div class="subgallery">
        <div class="gallery-title">
            <h2>Animations</h2>
            <div class="click-notice">Click to view full size</div>
        </div>
        @foreach($animations as $animation)
            <x-gallery-art
                :sequence="$sequence++"
                src="/{{$animation->thumb_src}}"
                href="/{{$illustration->img_src}}" :openlightbox="$illustration->openlightbox">
                <h2 class="caption-title">{{ $animation->title }}</h2>
                <p>{!! $animation->description !!}</p>
            </x-gallery-art>
        @endforeach
    </div>

@endsection