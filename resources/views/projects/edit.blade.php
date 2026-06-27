@extends("layouts.canonical")

@section("title"){{ "Edit Project: " . $project->label_title }}@endsection

@section("head")
@include('projects.js-positioner')
@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/project-editor", "title"=>"Edit projects"],
            ["href"=>"/project-editor/".$project->item_id, "title"=>$project->label_title]
        ]
    ])
@endsection

@section("content")

    <div class="bannerbutton" id="positioner" style="transition: none; background-image: url({{  $project->background_image }}); background-position: {{ $project->background_position }}">
        <div class="bannerlabel @if($project->dark) darker @endif" style="user-select: none;">Click and drag to reposition background</div>
    </div>
    <form action="" method="post" class="editor">
        @csrf
        @method("PUT")
        <input class="editor-text" type="text" id="href" name="href" value="{{ $project->href }}">
        <input class="editor-text" type="text" id="background_image" name="background_image" value="{{ $project->background_image }}" onchange="$('#positioner').css('background-image', 'url('+this.value+')')">
        <input class="editor-text" type="text" id="background_position" name="background_position" value="{{ $project->background_position }}">
        <input class="editor-text" type="text" id="category" name="categories" placeholder="Category" value="{{ $project->category_string }}">
        <input class="editor-text" type="text" id="label_title" name="label_title" value="{{ $project->label_title }}">
        <input class="editor-text" type="number" id="order" name="order" placeholder="Display order" value="{{ $project->order }}">
        <textarea class="editor-body" id="label_text" name="label_text">{{ $project->label_text }}</textarea>
        <input type="checkbox" id="dark" name="dark" onchange="$('#positioner').find('.bannerlabel').toggleClass('darker')" @if($project->dark) checked @endif>
        <label for="dark">Darker overlay</label>
        <button id="submit">Update project</button>
    </form>
@endsection