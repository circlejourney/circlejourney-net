@extends("layouts.canonical")

@section("title"){{ "Edit Project: " . $project->label_title }}@endsection

@section("head")
    <script>
        window.onload=function() {
            const bannerheight = $("#positioner").height();
            $("#positioner").on("mousemove", function(e){
                if(!e.originalEvent.buttons) return false;
                const currentBgTop = $("#positioner").css("background-position").split(" ").map(val=>parseInt(val));
                const prevY = parseInt($("#positioner").data("previous-y"));
                const dY = (e.originalEvent.clientY - prevY)/5;
                const newBgTop = [
                    currentBgTop[0]+"%",
                    Math.round(currentBgTop[1] - dY)+"%"
                ];
                $("#positioner").css("background-position", newBgTop.join(" "));
                $("#background_position").val("center "+newBgTop[1]);
                $("#positioner").data("previous-y", e.originalEvent.clientY);
            });

            $(window).on("mouseup", function(e){
                $("#positioner").removeData("previous-y");
            })
        }
    </script>
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
        <input class="editor-text" type="text" id="category" name="category" placeholder="Category" value="{{ $project->category }}">
        <input class="editor-text" type="text" id="label_title" name="label_title" value="{{ $project->label_title }}">
        <input class="editor-text" type="number" id="order" name="order" placeholder="Display order" value="{{ $project->order }}">
        <textarea class="editor-body" id="label_text" name="label_text">{{ $project->label_text }}</textarea>
        <input type="checkbox" id="dark" name="dark" onchange="$('#positioner').find('.bannerlabel').toggleClass('darker')" @if($project->dark) checked @endif>
        <label for="dark">Darker overlay</label>
        <button id="submit">Update project</button>
    </form>
@endsection