function Popup(text, parent) {
    const popup = $("<div class='pop'></div>").append(
        $("<span class='pop-text'></span>").text(text)
    );
    $(parent).append(popup);
    popup.animate = function() {
        $(this).animate({"opacity": 0 }, function(){
            $(this).remove();
        });
    }
    return popup;
}