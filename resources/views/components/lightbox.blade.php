<div id="lightbox" class="hidden">
    <div class="lightbox-nav lightbox-prev">&lt;</div>
    
    @foreach($artworks as $artwork)
    <div class="lightbox-image hidden">
        @isset($artwork->description)<p>{{ $artwork->description }}</p>@endisset
        <img src="/{{$artwork->img_src}}" onclick="event.stopPropagation()">
    </div>
    @endforeach

    <div class="lightbox-nav lightbox-next">&gt;</div>
</div>