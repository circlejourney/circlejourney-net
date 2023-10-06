var playButton;
var stopButton;
var rSlider;
var gSlider;
var bSlider;
var mySound;
var volSlider;
var osc;

function preload() {
    mySound = loadSound("ambient00.mp3");
}

function setup() {
  createCanvas(400, 400);
  background(128);
  playButton = createButton('Play');
  playButton.position(20, 100);
  playButton.mousePressed(playSound);
  playButton.style("background-color", "#ACD");
  stopButton = createButton('Stop');
  stopButton.position(60, 100);
  stopButton.mousePressed(stopSound);
  
  volSlider = createSlider(0, 100, 100);
  volSlider.position(20, 50);
  volSlider.mouseMoved(changeVolume);
  
  rSlider = createSlider(0, 255, 128);
  rSlider.mouseMoved(changeBGRange);
  rSlider.position(0, 120);
  gSlider = createSlider(0, 255, 128);
  gSlider.mouseMoved(changeBGRange);
  gSlider.position(0, 140);
  bSlider = createSlider(0, 255, 128);
  bSlider.mouseMoved(changeBGRange);
  bSlider.position(0, 160);
  
  var name = prompt("What's your name?");
  if(confirm("Do you want to continue?")) {
      text(name+" pressed OK.", 10, 100);
  } else {
      text(name+" pressed Cancel.", 10, 100);
  }
  
  var inp = createInput("");
  inp.input(myInputEvent);
}

function myInputEvent() {
    console.log("You are typing: "+this.value());
}

function changeBG() {
  var val = random(255);
  background(val);
  slider.value(val);
}

function playSound() {
    if(!mySound.isPlaying()) {
        mySound.play();
    }
}

function changeVolume() {
    var vol = map(volSlider.value(), 0, 100, 0, 1);
    mySound.setVolume(vol);
}

function stopSound() {
    mySound.pause();
}

function changeBGRange() {
    var col = color(rSlider.value(), gSlider.value(), bSlider.value());
    background(col);
}