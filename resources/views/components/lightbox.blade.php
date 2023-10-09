<div id="lightbox" class="hidden">
    <div class="lightbox-nav lightbox-prev">&lt;</div>
    
    @foreach($artworks as $artwork)
    <div class="lightbox-display hidden">
        <h2 class="lightbox-title">{{ $artwork->title }}</h2>
        @isset($artwork->description)<p>{!! $artwork->description !!}</p>@endisset
        <div class="lightbox-image">
            <img src="/{{$artwork->img_src}}" onclick="event.stopPropagation()">
        </div>
    </div>
    @endforeach

    <div class="lightbox-nav lightbox-next">&gt;</div>
</div>