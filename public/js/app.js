$.getJSON("/js/bg.json", function(bglist) {
    var bg = bglist[Math.floor(Math.random()*bglist.length)];
    $("#blog-title-image-holder").css("background-image", `url(${bg.small})`);
    $("<img>").attr("src", bg.big)
        .on("load", function() {
            $("#blog-title-image-holder")
                .css("background-image", "url("+bg.big+")")
                .removeClass("blur"); 
        });
});

$(window).on("load", function(){
    
    $("<img>")
        .attr("src", "/images/logosmall.png")
        .on("load", function() {
            $("#blog-title-logo").attr("src", "/images/logosmall.png").removeClass("transparent");
        });
    
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

function openLightbox(url) {
    $("#lightbox-image").attr("src", "https://rebuild.circlejourney.net/images/logosmall.png");
    $("#lightbox-image").attr("src", url);
    $("#lightbox").removeClass("hidden");
}

function closeLightbox() {
    $("#lightbox").addClass("hidden");
}