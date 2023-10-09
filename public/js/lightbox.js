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
        if(sequenceNo < 0 || sequenceNo >= $(this.element).find(".lightbox-display").length) return false;
       
        $(document.body).addClass("freeze");
         $(this.element)
            .removeClass("hidden")
            .data("active", sequenceNo)
            .find(".lightbox-display:not(.hidden)").addClass("hidden");
        $(this.element).find(".lightbox-display").eq(sequenceNo).removeClass("hidden");
    }

    hide() {
        $(this.element).addClass("hidden");
        $(document.body).removeClass("freeze");
    }

    nav(delta) {
        const goto = parseInt($(this.element).data("active")) + delta;
        this.show(goto);
    }

}