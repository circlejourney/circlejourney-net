@extends("layouts.canonical")

@section('title'){{ "Interactive projects and games" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
        ["href"=>"/interactive", "title"=>"Interactive projects and games"]
    ]
    ])
@endsection

@section('content')
    <p class="center">
        You can also find me on:
        <br>
        <x-badge-link href="https://circlejourney.github.com">Github</x-badge-link>
        <x-badge-link href="https://circlejourney.itch.io">Itch.io</x-badge-link>
    </p>
    
    <div class="bannergrid">
        @foreach($projects as $i => $project)
            <?php $wide = $i % 3 == 0 || ($i == sizeof($projects)-1 && $i % 3 == 1) ?>
            <x-bannerbutton :class='$wide ? "" : "bannerbutton-50"' :project="$project"/>
        @endforeach
    </div>
@endsection