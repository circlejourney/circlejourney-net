var music = [];
var playMode = "sustain";

function preload() {
    music.push(loadSound('dizzy.wav'));
    music.push(loadSound('pop.wav'));
    music.push(loadSound('editit.wav'));
    music.push(loadSound('boing.wav'));
}

function setup() {
    createCanvas(400, 400);
    noStroke();
    frameRate(4);
    background(150);
    for(var i=0; i<music.length; i++) {
        music[i].playMode(playMode);
        fill(127*(i%2), 127*floor(i/2), 100);
        rect(200*(i%2), 200*floor(i/2), 200, 200);
        textAlign(CENTER);
        fill(255);
        text("Click me!", 200*(i%2)+100, 200*floor(i/2)+100);
    }
}

/*function draw() {
    if(frameCount%2 == 0) {
        music[1].play();
    }
    if(frameCount%4 == 0) {
        music[2].play();
    }
}*/

function drawButton() {
    
}

function mousePressed() {
    var index = floor(mouseY/200)*2 + floor(mouseX/200);
    music[index].play();
}

function doubleClicked() {
    var index = floor(mouseY/200)*2 + floor(mouseX/200);
    music[index].play();
}