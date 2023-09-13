<div class="bannergrid">
    @foreach($metalinks as $link)
    <x-thumb-banner class="bannerbutton-50" imgSrc="{{ $link->img_src }}" :href="$link->href">
        <h2><a href="{{ $link->href }}">{{ $link->title }}</a></h2>
        <div>
            {!! $link->description !!}
        </div>
        <span class="aside">
            {{ $link->publish_date_pretty() }}
        </span>
    </x-thumb-banner>
    @endforeach
</div>