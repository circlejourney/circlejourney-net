var cnv;
var d;
var g;
var startX;
var currentX;

function setup() {
  cnv = createCanvas(400, 400);
  cnv.touchStarted(touchStart); // attach listener for
  // canvas click only
  cnv.touchMoved(touchMove);
  cnv.touchEnded(touchEnd);
  d = 10;
  g = 100;
  startX = width/2;
}

function draw() {
  background(g);
  ellipse(width/2, height/2, d);
}

function touchStart() {
    //startX = touches[0].x;
}

function touchMove() {
    currentX = touches[0].x;
    d = currentX - startX;
}

function touchEnd() {
    
}