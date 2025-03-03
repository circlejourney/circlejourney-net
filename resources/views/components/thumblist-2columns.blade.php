<div class="bannergrid">
    @forelse($metalinks as $link)
    <x-thumb-banner class="bannerbutton-50" imgSrc="{{ $link->img_src }}" :href="$link->href">
        
        <span class="aside">
            {{ $link->publish_date_pretty() }}
        </span>
        <h2><a href="{{ $link->href }}">{{ $link->title }}</a></h2>
        <div>
            {!! $link->description !!}
        </div>
        
    </x-thumb-banner>
    @empty
    <p class="center">
        None found.
    </p>
    @endforelse
</div>