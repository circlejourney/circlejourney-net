
<div class="banner-grid {{ empty($alternate) ? "" : "alternate" }}">
    @forelse($projects as $i => $project)
        @if( empty($variable_rows) || $i % 3 === 0 )
            <x-bannerbutton :$project />
        @else
            <x-bannerbutton class="bannerbutton-50" :$project />
        @endif
    @empty
    <div>None found.</div>
    @endforelse
</div>