<div class="gallery-image">
    <a href="{{ $href }}" {{ $attributes }}>
        <img class="thumbnail" src="{{ $src }}">
    </a>
    <div class="caption">
        {{ $slot }}
    </div>
</div>