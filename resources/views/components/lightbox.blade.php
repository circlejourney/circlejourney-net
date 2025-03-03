<div id="lightbox" class="hidden">
    <div class="lightbox-nav lightbox-close"><i class="fa fa-times"></i></div>
    <div class="lightbox-nav lightbox-prev"><i class="fa fa-chevron-left"></i></div>
    
    @foreach($artworks as $artwork)
    <div class="lightbox-display hidden">

        <div class="lightbox-image-container">
            <img class="lightbox-image" src="/{{$artwork->img_src}}" onclick="event.stopPropagation()">
        </div>
        
        <div class="lightbox-info">
            <h2 class="lightbox-title">{{ $artwork->title }}</h2>
            @isset($artwork->description)<div class="lightbox-description">{!! $artwork->description !!}</div>@endisset
        </div>
        
    </div>
    @endforeach

    <div class="lightbox-nav lightbox-next"><i class="fa fa-chevron-right"></i></div>
</div>