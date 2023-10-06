let fruits = [];
var imageFiles;

function preload() {
    imageFiles = [
        loadImage("images/Blue_Orange.png"),
        loadImage("images/Fruit_Flower.png"),
        loadImage("images/Dragon_Fruit.png")
    ];
}

function setup() {
  createCanvas(1920, 1080);
  for(var j=0; j<7; j++) {
    for(var i=0; i<imageFiles.length; i++) {
        var fruit = new Fruit(imageFiles[i], random(width), random(height), random(-200, width+200), random(-200, height+200), random(30,40));
        fruits.push(fruit);
    }
  }
}

function draw() {
  background(0);
  for(var i=0;i<fruits.length; i++) {
      fruits[i].move(0.05);
  }
}


class Fruit {
  constructor(img, x, y, endX, endY, spd) {
    this.x = x;
    this.y = y;
    this.endX = endX;
    this.endY = endY;
    this.ang = 0;
    this.dY = endY - y
    this.dX = endX - x;
    this.xRatio = this.dX/sqrt(this.dY*this.dY + this.dX*this.dX);
    this.yRatio = this.dY/sqrt(this.dY*this.dY + this.dX*this.dX);
    this.spd = spd;
    this.w = 200;
    this.h = 200;
    this.img = img;
    this.negX = this.w/2 * -1;
    this.negY = this.h/2 * -1;
  }

  move(angInc) {
    if(abs(this.x-this.endX)>20) {
        this.x += this.spd * this.xRatio;
        this.y += this.spd * this.yRatio;
        this.ang += angInc;
    }
        translate(this.x, this.y);
        rotate(this.ang);
        image(this.img, this.negX, this.negY, this.w, this.h);
        rotate(this.ang * -1);
        translate(this.x * -1, this.y * -1);
  }
}

function mouseClicked() {
    fruits = [];
    setup();
}