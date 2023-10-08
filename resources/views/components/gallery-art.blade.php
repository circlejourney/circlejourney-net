<a class="gallery-image" @isset($clickthrough) href="{{ $href }}" @else onclick="openLightbox('{{ $href }}')" @endisset>
    <img class="thumbnail" src="{{ $src }}">
    <div class="caption">
        <p>{{ $slot }}</p>
    </div>
</a>