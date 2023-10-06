var on = false;
var bgcol;
var topcol;
var mtn;
var moon;
var snowParticles = [];

function Snow(x, y, r, xspd, yspd, maxAge) {
    this.x = x;
    this.y = y;
    this.r = r;
    this.maxAge = maxAge;
    this.xspd = xspd;
    this.yspd = yspd;
    
    snowParticles.push(this);
    this.draw = function() {
        var opacity;
        if(maxAge - this.maxAge < 24) opacity = 0.5 * (maxAge - this.maxAge)/24;
        else if (this.maxAge < 24) opacity = 0.5 * this.maxAge/24;
        else opacity = 0.5;
        fill("rgba(255,255,255," + opacity + ")");
        ellipse(this.x, this.y, this.r);
    }
}

function turnOn () {
    bgcol = color(80, 90, 140);
    topcol = color(60, 65, 112);
    on = true;
}

function turnOff() {
    bgcol = color(210, 235, 245);
    topcol = color(175, 210, 225);
    on = false;
}

function preload() {
    mtn = loadImage("mtn.png");
    moon = loadImage("moon.png");
}

function setup() {
    turnOff();
    createCanvas(400, 600);
    for(var i = 0; i < 50; i++) {
        new Snow(random(0,width), random(0,height), random(2, 5), random(1,3), random(1,3), floor(random(100,200)));    
    }
      textSize(54);
      textAlign(CENTER);
      textFont("Georgia");
}

function draw() {
  background(bgcol);
  for(var i=0; i < 2*height/3; i++) {
      fill(lerpColor(topcol, bgcol, i/(2*height/3)));
      rect(0, i, width, 2);
  }
  if(on) {
      blendMode(ADD);
      image(moon, 10, 35, 280, 280);
  }
      blendMode(ADD);
  image(mtn, -50, height-471);
      blendMode(BLEND);
  if(on) {
      fill("rgba(90, 100, 150, 0.4)");
      blendMode(MULTIPLY);
      rect(0,0,width,height);
      blendMode(BLEND);
        
      fill(255);
        text("Good night.", width/2, 170);
      
      for(var i=0;i<snowParticles.length;i++) {
          if(snowParticles[i].x < 0) {
              snowParticles[i].x += width;
          }
          if(snowParticles[i].y > height) {
              snowParticles[i].y -= height;
          }
          snowParticles[i].x -= snowParticles[i].xspd;
          snowParticles[i].y += snowParticles[i].yspd;
          noStroke();
          fill(255,0.5);
          snowParticles[i].draw();
          snowParticles[i].maxAge -= 1;
          if(snowParticles[i].maxAge <= 0) {
              snowParticles.splice(i,1);
                new Snow(random(0,width), random(0,height), random(3, 5), random(1,3), random(1,3), floor(random(100,200)));
          }
      }
  } else {
      
      blendMode(ADD);
      noStroke();
      fill(255);
        ellipse(300, 90, 150);
        
        blendMode(BLEND);
        fill(80, 90, 140);
        text("Good morning.", width/2, 170);
  }
}

function mouseClicked() {
    if(!on) {
        turnOn();
    } else {
        turnOff();
    }
}