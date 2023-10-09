class Lightbox {
    constructor(element) {
        this.element = element;
        $(window).on("keydown", ((e)=>{
            if($(this.element).hasClass("hidden")) return;
            if(e.keyCode == 37) this.nav(-1);
            if(e.keyCode == 39) this.nav(1);
            if(e.keyCode == 27) this.hide();
        }));

        $(this.element).on("click", ()=>{
            this.hide();
        });

        console.log($(this.element).find(".lightbox-prev"));
        $(this.element).find(".lightbox-prev").on("click", (e)=>{
            e.stopPropagation();
            this.nav(-1);
        })

        $(this.element).find(".lightbox-next").on("click", (e)=>{
            e.stopPropagation();
            this.nav(1);
        })
    }

    show(sequenceNo) { // Shows image in lightbox based on integer representing its ordinal position in the gallery.
        if(sequenceNo < 0 || sequenceNo >= $(this.element).find(".lightbox-image").length) return false;
        $(this.element)
            .removeClass("hidden")
            .data("active", sequenceNo)
            .find(".lightbox-image:not(.hidden)").addClass("hidden")
        $(this.element).find(".lightbox-image").eq(sequenceNo).removeClass("hidden")
    }

    nav(delta) {
        const goto = parseInt($(this.element).data("active")) + delta;
        this.show(goto);
    }

    hide() {
        $(this.element).addClass("hidden");
    }

}