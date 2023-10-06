var drawNow;
var prevX;
var prevY;
var mycol;

function setup() {
  createCanvas(400, 400);
  frameRate(25);
  background(0);
}

function draw() {
  if (mouseIsPressed === true) {
    startcol = mycol;
    mycol = color(random(140, 255), random(220), random(200));

    var dX = mouseX - prevX;
    var dY = mouseY - prevY;
    var distance = Math.floor(Math.sqrt(Math.pow(dX, 2) + Math.pow(dY, 2)));
    for (var i = 0; i < distance; i++) {
      stroke(lerpColor(startcol, mycol, i / distance));
      point(prevX + (dX / distance) * i, prevY + (dY / distance) * i);
    }

    stroke(mycol);
    fill(mycol)
    star(mouseX, mouseY, random(2, 10));
    // drawNow = false;
    prevX = mouseX;
    prevY = mouseY;
  }
}

function mousePressed() {
  drawNow = true;
  //line(prevX, prevY, mouseX, mouseY);
}

function mouseReleased() {
  drawNow = false;
}

function star(x, y, size) {
  var left = x - size;
  var right = x + size;
  triangle(x, y + size, left, y - size / 2, right, y - size / 2);
  triangle(x, y - size, left, y + size / 2, right, y + size / 2);
}