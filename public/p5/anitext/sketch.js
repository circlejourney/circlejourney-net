var displayImage, canvas, vid;
var c = [];
const TILE = 5;
const letters = "nevergonnagiveyouup";

function preload() {
  //displayImage = loadImage("compasscrop.jpg");
  //displayVid = loadVideo("compasscrop.jpg");
}

function setup() {
  vid = createVideo("never360_Trim.mp4", vidLoad);
  vid.hide();
  canvas = createCanvas(vid.width, vid.height);
  canvas.hide();
  for(var h=0; h<floor(height/TILE); h++) {
    for(var w=0; w<floor(width/TILE); w++) {
      $("#text").append(
        $("<span>a</span>")
          .addClass("letter-tile")
          .attr("id", "h"+h+"w"+w)
      );
    }
    $("#text").append("<br>");
  }
}

function draw() {
  image(vid, 0, 0, width, height);
  let pointer = 0;
  for(var h=0; h<floor(height/TILE); h++) {
    for(var w=0; w<floor(width/TILE); w++) {
      let slice = get(w*TILE, h*TILE, TILE, TILE);
      let avg = getAvgColor(slice);
      $("#h"+h+"w"+w)
        .text(letters[(pointer+floor(vid.time())) % letters.length])
        .css("color", avg)
      pointer++;
    }
  }
}


function getAvgColor(img) {
  let cols = [0, 0, 0, 0];

  let key = ["r", "g", "b", "a"];
  
  img.loadPixels();
  let pixels = img.pixels;
  pixels.forEach(function(val, i){
    cols[i % 4] += val;
  });

  for(var [k, v] of Object.entries(cols)) {
    cols[k] = floor(v/(pixels.length/4));
  };

  return color(...cols);
}

function vidLoad() {
  vid.loop();
  vid.volume(0);
}