var img;
var dim = 30;

function preload() {
    img = loadImage("images.jpg");
}

function setup() {
    noStroke();
    createCanvas(400, 400);
  for(var i=0; i<width; i+=dim) {
      for(var j=0;j<height;j +=dim) {
            image(img, i, j, dim, dim);
            if(i%60 + j%60 == 0) rect(i, j, dim, dim);
      }
  }
}