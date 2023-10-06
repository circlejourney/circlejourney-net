var starImg = [];
var imgList = ["images/Dragon_Fruit.png", "images/star.png", "images/star2.png", "images/star3.png"];
var x = 0;
var y = 0;
var throwing = false;
var angle = 0.0;

function preload() {
    for(var i=0; i<imgList.length; i++) {
        starImg.push({
            "image": loadImage(imgList[i]),
            "y": random(400), //sets the y position
            "angle": random(2*PI) //sets the starting rotation
        });
    }
}

function setup() {
    createCanvas(1200, 400);
    y = height/2;
    frameRate(100);
}

function draw() {
    background(0);
    if (throwing) {
        for(var i=0; i<starImg.length; i++) {
            push();
            translate(x, starImg[i].y);
            rotate(starImg[i].angle);
            image(starImg[i].image, 0 - starImg[i].image.width/2, 0 - starImg[i].image.height/2);
        
            if (x <= width + starImg[i].image.width / 2) {
                x += 5;
            } else {
                throwing = false;
                x = 0;
                console.log("stopped");
            }
            pop();
            starImg[i].angle += 0.05;
        }
    }
}

function keyPressed() {
  if (keyCode === RIGHT_ARROW) {
      throwing = true;
      console.log("throwing");
  }
}
