<div class="gallery-image">
    <a href="{{ $href }}" {{ $attributes }}>
        <img class="thumbnail" src="{{ $src }}">
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