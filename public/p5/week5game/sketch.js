var bgImg, treeImg, grassImg, cactusImg, explodeImg, spriteTemplate;
var treePos = [];
var treeCnt = 3;
var cacPos = [];
var cacCnt = 2;
var cactusCount = 0;
var cactusScale = .4;
var camelFrames = {
    left: [],
    right: []
}
var currWalk = 0;
var x = 0;
var camelY = 170;
var moving = false;
var direction = 0;
var jumping = -1;
var jumpSpd = 30;
var jumpBoost = 1.5;
var jumpHeight = 170;
var fgx = 0;
var spd = 0;
var maxSpd = 4;
var accel = 0.2;
var friction = 0.4;
var facing = "right";
var cactusX = 0;
var exploded = false;
var scored = false;
var explodeTime = 0;
var score = 0;
var scoreParticle = "+";
var scoreAge = 50;
var scoreParticlePos = [0, 0];
var bgm, squish, bounce, thud, hooves;

function preload() {
   bgImg = loadImage('desert.png');
   treeImg = loadImage('bigcactus.png');
   for(var i=1;i<=12;i++) {
        var img = loadImage("camel/" + ("0"+i).slice(-2) + ".png");
        camelFrames.left.push(img);
        var flipimg = loadImage("camelflip/" + ("0"+i).slice(-2) + ".png");
        camelFrames.right.push(flipimg);
   }
   spriteTemplate = camelFrames.right[0];
   cactusImg = loadImage("smallcactus.png");
   explodeImg = loadImage("explosion.png");
   bgm = loadSound("camels.mp3");
   bgm.setVolume(0.5);
   squish = loadSound("squish.wav");
   bounce = loadSound("boing.wav");
   thud = loadSound("thud.wav");
   hooves = loadSound("hooves.mp3");
}

function setup() {
  createCanvas(bgImg.width, bgImg.height);
    frameRate(90);
    bgm.loop();
    for (var i=0; i<treeCnt; i++) {
        treePos[i] = random(400) + width * i;
    }
  cactusX = width + random(width);
  textSize(32);
  
}


function draw() {
    background(255);
    
    var sprite;
    
    jump();
    walk();
    collideCheck();
    
    if(!jumping) {
        camelY = 0;
        sprite = camelFrames[facing][currWalk];
    }
    else sprite = camelFrames[facing][7];
    
    //DRAWING
    
    image(bgImg, x, 0);
    image(bgImg, x + width, 0);
    
    noStroke();
    fill(250,240,140);
    rect(0, height-50, width, 50);
    
    for (var i=0; i<treeCnt; i++) {
        image(treeImg, treePos[i], height-treeImg.height-30);
    }
    
    image(sprite, width/2-sprite.width/8, height-sprite.height/4-camelY, sprite.width/4, sprite.height/4)
    ;
    
    if(exploded === true) {
        switch(explodeTime) {
        case 2: 
            blendMode(ADD);
            break;
        case 1:
            blendMode(LIGHTEST);
            break;
        }
        if(explodeTime > 0) {
            if(frameCount%6 == 0) explodeTime--;
            image(explodeImg, cactusX, height-cactusImg.height*cactusScale, cactusImg.width*cactusScale, cactusImg.height*cactusScale);
        }
        blendMode(BLEND);
    } else {
        image(cactusImg, cactusX, height-cactusImg.height*cactusScale-10, cactusImg.width*cactusScale, cactusImg.height*cactusScale);
    }
    
    if(scoreAge < 30) {
        scoreParticlePos[0] = cactusX;
        if(scoreParticle == "+") fill(0,255,0, 255*(30-scoreAge)/30);
        else fill(255, 0, 0, 255*(30-scoreAge)/30);
        
        scoreParticlePos[1]-=3;
        scoreAge++;
        textStyle(BOLD);
        textAlign(CENTER);
        textSize(70);
        text(scoreParticle, scoreParticlePos[0], scoreParticlePos[1]);
    }
    
    if(score < 0) fill(255,0,0);
    else fill(0);
    
    textSize(32);
    textAlign(LEFT);
    textStyle(NORMAL);
    text("Score: "+score,5,30);
}

function walk() {
    if(keyIsDown(RIGHT_ARROW) || keyIsDown(LEFT_ARROW)) {
        if(!hooves.isPlaying() && jumping == 0) hooves.loop();
        
        if(keyIsDown(RIGHT_ARROW)) {
            direction = 1;
            facing = "right";
        } else if(keyIsDown(LEFT_ARROW)) {
            direction = -1;
            facing = "left";
        }
        if(frameCount % 4 === 0) currWalk = (currWalk+1)%12;
        if(abs(spd) < maxSpd) spd+=direction*accel;
        else slow();
    } else if(abs(spd)>0) {
        slow();
        hooves.stop();
    } else {
        hooves.stop();
    }
    
    x -= spd;
    if(x < -width) x = 0;
    if(x > 0) x = -width;
    
    fgx -= spd*3;
        
    for (var i=treeCnt-1; i>=0; i--) {
        treePos[i] -= spd*2;
        if (Math.abs(treePos[i]-width/2) > width + treeImg.width) {
            treePos[i] = width/2 + direction*(width/2 + treeImg.width + random(400));
        }
    }
        
    cactusX -= spd*2.5;
    if(cactusX < -cactusImg.width*cactusScale) {
        if(exploded) exploded = false;
        scored = false;
        cactusX = width+random(width);
        cactusCount++;
    }
}

function slow() {
    if(!jumping) {
        if(Math.abs(spd)>friction){
            if(spd>0) spd -= friction;
            if(spd<0) spd += friction
        } else {
            spd = 0;
        }
    }
}

function jump() {
    if(keyIsDown(UP_ARROW) && jumping === 0) {
        bounce.play();
        hooves.stop();
        spd += jumpBoost;
        jumping = 1;
    }
    
    switch(jumping) {
        case 1:
            if(camelY < jumpHeight) {
                camelY += 1+jumpSpd*(jumpHeight-camelY)/jumpHeight;
            } else {
                jumping = -1;
            }
            break;
        case -1:
            if(camelY > 1+jumpSpd*(jumpHeight-camelY)/jumpHeight) {
                camelY -= 1+jumpSpd*(jumpHeight-camelY)/jumpHeight;
            } else {
                thud.play();
                jumping = 0;
                currWalk = 8;
            }
            break;
    }
}

function collideCheck() {
    if(!exploded && width/2+spriteTemplate.width/8 - cactusX > 115 && cactusX + cactusImg.width*cactusScale-(width/2-spriteTemplate.width/8) >= 20 && !jumping) {
        score -= 1;
        scored = true;
        exploded = true;
        squish.play();
        explodeTime = 2;
        scoreParticle="-";
        scoreParticlePos[1] = height-cactusImg.height*cactusScale;
        scoreAge=0;
    }
    if(!scored && cactusX+cactusImg.width*cactusScale <= width/2-spriteTemplate.width/8 && jumping == -1){
        score++;
        scoreParticle="+";
        scoreAge=0;
        scoreParticlePos[1] = height-cactusImg.height*cactusScale;
        scored = true;
    }
}

function scoreAnimate() {
    scoreParticleAge = 0;
}