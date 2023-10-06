var starImg = [];
var x = 0;
var y = 0;
var throwing = false;
var angle = 0.0;

function preload() {
   starImg = loadImage('images/Dragon_Fruit.png');
}

function setup() {
  createCanvas(1200, 400);
  y = height/2;
  frameRate(100);
}

function draw() {
    background(0);
    if (throwing) {
        translate(x, height/2);
        rotate(angle);
        image(starImg, 0 - starImg.width/2, 0 - starImg.height/2);
        angle += 0.05;
        if (x < width + starImg.width/2) {
            x += 5;
        } else {
            throwing = false;
            x = 0;
            console.log("stopped");
        }
    }
}

function keyPressed() {
  if (keyCode === RIGHT_ARROW) {
      throwing = true;
      console.log("throwing");
  }
}
