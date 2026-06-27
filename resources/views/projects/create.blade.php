@extends("layouts.canonical")

@section("title"){{ "Create New Project" }}@endsection

@section("head")
@include('projects.js-positioner')
@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/project-editor", "title"=>"Edit projects"],
            ["href"=>"/project-editor/create", "title"=>"Create new project"]
        ]
    ])
@endsection

@section("content")
    <div class="bannerbutton" id="positioner" style="transition: none; background-position: center 15%;">
        <div class="bannerlabel" style="user-select: none;">Click and drag to reposition background</div>
    </div>
    <form action="" method="post" class="editor">
        @csrf
        <input class="editor-text" type="text" id="item_id" name="item_id" placeholder="Project ID (no whitespace)">
        <input class="editor-text" type="text" id="href" name="href" placeholder="Link to project">
        <input class="editor-text" type="text" id="background_image" name="background_image" onchange="$('#positioner').css('background-image', 'url('+this.value+')')" placeholder="Background image URL">
        <input class="editor-text" type="text" id="background_position" name="background_position" value="center 15%"  onchange="$('#positioner').css('background-position', this.value)" placeholder="Background position">
        <input class="editor-text" type="text" id="label_title" name="label_title" placeholder="Title">
        <input class="editor-text" type="text" id="categories" name="categories" placeholder="Category">
        <input class="editor-text" type="number" id="order" name="order" placeholder="Display order" value="0">
        <textarea class="editor-body" id="label_text" name="label_text" placeholder="Description HTML"></textarea>
        <input type="checkbox" id="dark" name="dark" onchange="$('#positioner').find('.bannerlabel').toggleClass('darker')">
        <label for="dark">Darker overlay</label>
        <button id="submit">Update project</button>
    </form>
@endsection