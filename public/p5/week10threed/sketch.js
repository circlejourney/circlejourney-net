var bigA;

function preload() {
    bigA = loadModel("bigA.obj");
}

function setup() {
  createCanvas(300, 300, WEBGL);
}

function draw() {
  background(200);
  push();
  noStroke();
  rotateX(frameCount * 0.01);
  rotateY(frameCount * 0.01);
    translate(0, 0, 0);
  fill(255, 200, 200);
  box(25);
  fill(128, 128, 255);
  for(var i=0; i<3; i++) {
    translate(i*10, i*10*Math.sign(i%2-1), i*10 + sin(frameCount/10)*20);
    sphere(10);
  }
  for(var i=0; i<20; i++) {
      fill(255);
    translate(sin(frameCount/10), sin(frameCount/10), cos(frameCount/10)+i/2);
    sphere(5);
  }
  fill(255, 200, 255);
  cylinder(20,50);
  pop();
  scale(5);
  translate(10,0,0);
  fill(255,200,255);
  model(bigA);
}