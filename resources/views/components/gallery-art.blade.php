<div class="gallery-art">
    <a class="gallery-thumb-link" href="{{ $href }}" {{ $attributes }}>
        <img class="gallery-thumbnail" src="{{ $src }}">
    </a>
    <div class="caption">
        @isset($title)    
            <h2 class="caption-title">
                <a href="{{ $href }}" {{ $attributes}}>
                    {{ $title }}
                </a>
            </h2>
        @endisset
        {{ $slot }}
    </div>
</div>