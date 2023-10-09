<div id="lightbox" class="hidden">
    <div class="lightbox-nav lightbox-prev"><i class="fa fa-chevron-left"></i></div>
    
    @foreach($artworks as $artwork)
    <div class="lightbox-display hidden">
        <h2 class="lightbox-title">{{ $artwork->title }}</h2>
        @isset($artwork->description)<p>{!! $artwork->description !!}</p>@endisset
        <img class="lightbox-image" src="/{{$artwork->img_src}}" onclick="event.stopPropagation()">
    </div>
    @endforeach

    <div class="lightbox-nav lightbox-next"><i class="fa fa-chevron-right"></i></div>
</div>