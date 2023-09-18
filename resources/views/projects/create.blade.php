@extends("layouts.canonical")

@section("title"){{ "Create New Project" }}@endsection

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
        <input class="editor-text" type="text" id="category" name="category" placeholder="Category">
        <input class="editor-text" type="number" id="order" name="order" placeholder="Display order" value="0">
        <textarea class="editor-body" id="label_text" name="label_text" placeholder="Description HTML"></textarea>
        <input type="checkbox" id="dark" name="dark" onchange="$('#positioner').find('.bannerlabel').toggleClass('darker')">
        <label for="dark">Darker overlay</label>
        <button id="submit">Update project</button>
    </form>
@endsection