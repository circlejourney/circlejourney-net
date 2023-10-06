var mozzies = [];
var splats = ["splat.png","splat2.png","splat3.png"];
var splatImages = [];
var sX = 0;
var yX = 0;
var colPoint = 0;
var col1;
var col2;
var points = 0;
var desk;
var win = false;
var intv;
var timer = 0;
var deadcount = 0;

var tSpeed = 10;
var tSize = 32;
var tX = 0;
var tY = 50;
var tCnt = 100;

function Mosquito(x, y, xcnt, ycnt) {
    this.x = x;
    this.y = y;
    this.xcnt = xcnt;
    this.ycnt = ycnt;
    this.dead = false;
    this.splatImage = "";
    
    this.kill = function(dist) {
        points += 200-dist
        this.splatImage = splatImages[floor(random(3))];
        this.dead = true;
    }
    
    mozzies.push(this);
}

function preload() {
    mos = loadImage("mos.png");
    hand = loadImage("hand.png");
    desk = loadImage("wall.jpg");
    for(var i = 0; i<splats.length; i++) {
        splatImages[i] = loadImage(splats[i]);
    }
}

function setup() {
    createCanvas(1200,1200);
    console.log(width);
    imageMode(CENTER);
    col1 = color(100,0,0);
    col2 = color(255,random(255),random(255));
    for(var i=0;i<10;i++) {
        new Mosquito(random(0,width),random(0,width), random(0,PI), random(0,PI) );
    }
}

function draw() {
    image(desk, width/2, height/2, width*1.5, height);
    if(mouseX > 100 && mouseX < 300 && mouseY > 70 && mouseY < 100) {
        if(tSize < 46) tSize += 0.5;
        if(tSpeed < 30) tSpeed ++;
        if(colPoint<1) {
            colPoint += 0.02;
        }
    } else {
        if(tSize > 32) tSize -= 0.5;
        if(tSpeed > 10) tSpeed --;
        if(colPoint>0) {
            colPoint -= 0.02;
        }
    }
    
    fill(lerpColor(col1, col2, colPoint));
    textSize(tSize);
    textAlign(CENTER);
    text("Splat the mosquitoes!", tX, tY);
    tCnt += 0.01;
    tX = sin(tCnt) * tSpeed + width/2;
    deadcount = 0;
    
    for(var i = 0; i < mozzies.length; i++) {
        if(mozzies[i].dead) {
            deadcount++;
            blendMode(MULTIPLY);
            image(mozzies[i].splatImage, mozzies[i].x, mozzies[i].y, 200, 200);
            blendMode(BLEND);
        } else {
            image(mos, mozzies[i].x, mozzies[i].y, 70, 50);
            mozzies[i].xcnt += random(0.05,0.1);
            mozzies[i].ycnt += random(0,0.1);
            mozzies[i].x = sin(mozzies[i].xcnt) * 500 + 500;
            mozzies[i].y = sin(mozzies[i].ycnt) * 500 + 500;
        }
    }
    
    if(frameCount % 30 == 0 && !(deadcount>=10)) timer++;
    
    if(mouseIsPressed) {
        image(hand, mouseX, mouseY, 160,180)
    } else {
        image(hand, mouseX, mouseY);
    }
    
    if(deadcount >= 10) {
        fill(100,0,0);
        textSize(80);
        stroke(255);
        strokeWeight(2);
        text("You won in "+timer+" seconds!", width/2, height/2);
    }
    
    
}

function mouseClicked() {
    for(var i=0;i<mozzies.length; i++) {
        if(mouseX > mozzies[i].x-100 && mouseX < mozzies[i].x+100 && mouseY > mozzies[i].y-100 && mouseY < mozzies[i].y+100 && !mozzies[i].dead) {
            dist = floor(sqrt(pow(abs(mouseX - mozzies[i].x),2) + pow(abs(mouseY - mozzies[i].y),2)));
            mozzies[i].kill(dist);
        }
    }
}