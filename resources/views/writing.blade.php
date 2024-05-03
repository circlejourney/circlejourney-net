@extends("layouts.canonical", ["title"=>$title, "projects"=>$projects])

@section("title"){{ $title }}@endsection

@section("content")
    <div class="center">
        <x-badge-link :href="route('writing.portfolio')">Writing portfolio</x-badge-link>
        <x-badge-link href="https://circlejourney.net/read">Story reading app</x-badge-link>
    </div>
    
    <div class="bannergrid">
        @foreach($projects as $project)
            <x-bannerbutton class="bannerbutton" :$project />
        @endforeach
    </div>
@endsection