@extends("layouts.canonical")

@section("title"){{ "Edit Projects" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/project-editor", "title"=>"Edit projects"]
        ]
    ])
@endsection

@section("content")
<p class="center">
    <a href="/project-editor/create">Create new project</a>
</p>

<div class="bannergrid">
    @foreach($projects as $project)
        <?php
            $project->href = "/project-editor/".$project->item_id
        ?>
        <x-bannerbutton :project="$project" class="bannerbutton-50" />
    @endforeach
</div>
@endsection