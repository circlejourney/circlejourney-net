let images = [];
var imageFiles;

function preload() {
    imageFiles = [
        loadImage("images/Blue_Orange.png"),
        loadImage("images/Fruit_Flower.png"),
        loadImage("images/Dragon_Fruit.png")
    ];
}

function setup() {
  createCanvas(1000, 1000);
  for(var j=0; j<20; j++) {
    for(var i=0; i<imageFiles.length; i++) {
        var fruit = new Fruit(imageFiles[i], -random(200), random(height), random(width/2, width), random(height), 5+i*5);
        images.push(fruit);
    }
  }
}

function draw() {
  background(200);
  for(var i=0;i<images.length; i++) {
      images[i].move(0.05);
      //print(b_orange.x + " " + f_flower.x);
      //print(b_orange.ang + " " + f_flower.ang);
  }
}


class Fruit {
  constructor(img, x, y, endX, endY, spd) {
    this.x = x;
    this.y = y;
    this.endX = endX;
    this.endY = endY;
    this.ang = 0;
    this.dY = (endY - y)/(endX - x);
    this.spd = spd;
    this.w = 200;
    this.h = 200;
    this.img = img;
    this.negX = this.w/2 * -1;
    this.negY = this.h/2 * -1;
  }

  move(angInc) {
    if(this.x < this.endX) {
        this.x += this.spd;
        this.y += this.spd * this.dY;
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
    images = [];
    setup();
}