<div class="gallery-image">
    <a href="{{ $href }}" data-sequence="{{ $attributes["sequence"] }}">
        <img class="thumbnail" src="{{ $src }}">
    </a>
    <div class="caption">
        {{ $slot }}
    </div>
</div>