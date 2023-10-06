var img;

function preload() {
    img = loadImage("Sans.jpg");
}

function setup() {
    createCanvas(img.width, img.height);
  // put setup code here
}

function draw() {
  image(img, 0, 0);
  loadPixels();
  for(var i=1; i<200;i) {
      for(var j=1; j<200; j) {
          var index = pixIndex(i, j);
          
          if(pixels[index] == 0) {
              img.pixels[index-4] = 0;
              img.pixels[index-3] = 0;
              img.pixels[index-2] = 0;
              img.pixels[index-1] = 0;
          }
      }
  }
  updatePixels();
}

function pixIndex(x, y) {
    return (x + y * width) * 4;
}