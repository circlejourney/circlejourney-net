<div class="bannergrid">
    @foreach($metalinks as $link)
    <x-thumb-banner class="bannerbutton-50" imgSrc="{{ $link->img_src }}">
        <p>
            <a href="{{ $link->href }}">{{ $link->title }}</a>
            {!! $link->description !!}
        </p>
        <span class="aside">
            {{ $link->publish_date_pretty() }}
        </span>
    </x-thumb-banner>
    @endforeach
</div>