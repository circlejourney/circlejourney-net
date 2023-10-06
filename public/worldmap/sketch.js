var mapmap, map, ratio, pix, canvas, mapcontainer, density, activeCountry, openCountry, dictionary;

let promise1 = $(document).ready();
let promise2 = $.get("data.json", function(data) {
    dictionary = data;
})



function preload() {
    mapmap = loadImage("src/worldmapAAsmall.png");
    map = loadImage("src/worldmapblank.jpg");
}

function setup() {

    Promise.all([promise1, promise2]).then(function(){
        
        pixelDensity(1);
        
        
        canvas = createCanvas(map.width/2, map.height/2);
        canvas.mouseClicked(handleClick);
        
        canvas.id = "map-canvas";
        
        mapcontainer = createElement("div");
        mapcontainer.id("map-container");
        mapcontainer.style("width", width+"px");
        mapcontainer.style("height", height+"px");
        mapcontainer.child(canvas);
        
        tooltip = createElement("div");
        tooltip.id("tooltip");
        tooltip.child(createElement("div").id("tooltip-name"));
        tooltip.child(createElement("div").id("tooltip-shortinfo"));
        tooltip.child(createElement("a").id("tooltip-link").attribute("target", "_blank"));
        mapcontainer.child(tooltip);
        
        mapmap.loadPixels();
        pix = mapmap.pixels;
        image(map, 0, 0, width, height);
        
        tint(255, 60);
        image(mapmap, 0, 0, width, height);
        
    });
}


function countrylink(target){
    $(".pointer").remove();
    let pointer = $("<div></div>").addClass("pointer")
        .css("left", $(target).offset().left)
        .css("top", $(target).offset().top)
        .css("width", $(target).width())
        .css("border", "2px dashed #"+target.id);
    $("body").append(pointer);
    
    $(pointer)
        .animate(
        {
            left: dictionary[target.id].topleft[0] - 10,
            top: dictionary[target.id].topleft[1] - 10,
            width: dictionary[target.id].bottomright[0] - dictionary[target.id].topleft[0] + 10,
            height: dictionary[target.id].bottomright[1] - dictionary[target.id].topleft[1] + 10
        }, {
            duration: 600
        }
    )
    
    $(pointer).animate(
        {
            opacity: 0
        }, {
           queue: true,
           done: function(){
               $(this).remove();
           }
        }
    )
    
}

function handleClick(){
    if(openCountry != activeCountry && activeCountry.longinfo) {
        openCountry = activeCountry;
        $("#panel-title").html(activeCountry.name || "");
        $("#panel-content").html(activeCountry.longinfo || "");
        $("#panel").removeClass("invisible")
            .css("top",
                min(
                    activeCountry.avg[1] + 30, height - $("#panel").height() - 30
                )
            )
            .css("left", min(
                    activeCountry.avg[0] + 30, width - $("#panel").width() - 30
                )
            );
    } else {
        $("#panel").addClass("invisible");
        openCountry = false;
    }
}

function mouseMoved() {
    
    let startIndex = 4 * floor(mouseY) * width + 4 * floor(mouseX);
    let pixelColor = pix.slice(startIndex, startIndex + 3);
    let hex = dectohex(pixelColor[0]) + dectohex(pixelColor[1]) + dectohex(pixelColor[2]);
    if(dictionary[hex] && activeCountry != dictionary[hex]) {
        
        activeCountry = dictionary[hex];
        
        $("#tooltip").css("opacity", "1");
        $("#tooltip-name").html(activeCountry.name || "");
        
        if(openCountry != activeCountry) {
            $("#tooltip-shortinfo").html(activeCountry.shortinfo || "");
            if(activeCountry.longinfo) {
                cursor(HAND);
                $("#tooltip-shortinfo").append("<p id='tooltip-readmore'>(click to read more)</p>");
            } else cursor(ARROW);
        } else {
            $("#tooltip-shortinfo").html("");
        }
        
    } else if(!dictionary[hex]) {
        cursor(ARROW);
        activeCountry = false;
        $("#tooltip").css("opacity", "0");
    }
    
    $("#tooltip")
        .css("left", min(
                mouseX + 15, width - $("#tooltip").width() - 15
            )
        )
        .css("top", min(
                mouseY + 15, height - $("#tooltip").height() - 15
            )
        );
}

function dectohex(dec) {
    return ("0"+dec.toString(16)).substr(-2).toUpperCase();
}



function drawRects() {
    var pixeldict = {};
    
    for(var key in dictionary) {
        console.log(dictionary[key]);
        pixeldict[key] = {
            name: dictionary[key].name,
            pixels: []
    };
    }
    
    for(var i=0; i<pix.length; i+=4) {
        let hexcode = (dectohex(pix[i]) + dectohex(pix[i+1]) + dectohex(pix[i+2])).toUpperCase();
        if(pixeldict[hexcode]) {
            pixeldict[hexcode].pixels.push(i);
        }
    }
    
    for(var key in pixeldict) {
        let x = 0;
        let y = 0;
        let xmin = width;
        let ymin = height;
        let xmax = 0;
        let ymax = 0;
        let len = pixeldict[key].pixels.length;
        for(var i=0; i < pixeldict[key].pixels.length; i++) {
            thisx = (pixeldict[key].pixels[i]/4) % width;
            thisy = floor((pixeldict[key].pixels[i]/4) / width);
            x += thisx;
            y += thisy;
            xmin = thisx < xmin ? thisx : xmin;
            ymin = thisy < ymin ? thisy : ymin;
            xmax = thisx > xmax ? thisx : xmax;
            ymax = thisy > ymax ? thisy : ymax;
        }
    
        dictionary[key].avg = [floor(x/len), floor(y/len)];
        dictionary[key].topleft = [xmin, ymin];
        dictionary[key].bottomright = [xmax, ymax];
    
        stroke("#"+key);
        fill("#"+key);
        ellipse(floor(x/len), floor(y/len), 5, 5);
        let fillcol = color("#"+key);
        fillcol.setAlpha(50);
        fill(fillcol);
        rect(xmin, ymin, xmax-xmin, ymax-ymin);
    }
}