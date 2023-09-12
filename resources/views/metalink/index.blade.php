@extends("layouts.canonical")

@section("title") Edit Metalinks @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/metalink-editor", "title"=>"Edit metalinks"]
        ]
    ])
@endsection

@section("content")
<p class="center">
    <a href="/metalink-editor/create">Create a new metalink</a>
</p>

<ul>
    @foreach($metalinks as $metalink)
        <li><a href="/metalink-editor/{{ $metalink->item_id }}">{{ $metalink->title }}</a></li>
    @endforeach
</ul>
@endsection