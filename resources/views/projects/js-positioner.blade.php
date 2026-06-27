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