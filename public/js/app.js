$(window).on("load", function(){
    if("ontouchstart" in window) {
        $("#menu-button").after($(".breeze-submenu").attr("class", "submenu"));
        $(".submenu").each((i, val)=> {
                if(!$(val).children(".dropdown").length) return true;
                $(val).click((e)=>{
                    $($(e.target).children(".dropdown")[0]).toggleClass("open");
                });
            }
        );
    }
    // loadBannersPretty();
});


/* Call after page load on a page with banner-animate elements to make them fade in as the user scrolls */
function loadBannersPretty() {
    
    $(".banner-animate").addClass("fade-up");
    if($(".banner-animate").toArray().length > 0) {
        $(window).on('beforeunload', function() {
            $(window).scrollTop(0);
        });
    }
    
    $(window).scroll(function(e) {
        $(".fade-up").each((i, val) => {
            if(val.getBoundingClientRect().y <= window.innerHeight) {
                $(val).addClass("fading-up").removeClass("fade-up");
            }
        });
        if($(".fade-up").toArray().length === 0) {
            $(window).off("scroll");
        }
    });
    
}