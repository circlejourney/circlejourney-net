var mic;
var bee;
var playing = false;
var vid;
var button;
var filterNames = [["GRAY"], ["POSTERIZE", 4], ["THRESHOLD", 0.3], ["INVERT"], ["ERODE"], ["OPAQUE"]];
var currentFilter = 0;
var cap;

function preload() {
    bee = loadImage("bee.png");
}

function setup(){
    createCanvas(400,400);
  mic = new p5.AudioIn()
  mic.start();
  vid = createVideo('branches.mov');
  vid.hide();
  cap = createCapture(VIDEO);
    cap.hide();
  button = createButton('play');
  button.position(5, 5);
  button.mousePressed(toggleVid);
}
function draw(){
  background(0);
  image(vid, 0, 0)
  
  if(filterNames[currentFilter].length==1) {
    filter(filterNames[currentFilter][0]);
  } else {
    filter(filterNames[currentFilter][0], filterNames[currentFilter][1]);
  }
  
  blendMode(LIGHTEST);
  image(cap, 0, 0);
  blendMode(BLEND);
  
  micLevel = mic.getLevel();
  if(micLevel>0.5) console.log(micLevel);
  image(bee, width/2+width/2*sin(frameCount/10), constrain(height-micLevel*height*7, 0, height), 20, 20);
}

// plays or pauses the video depending on current state
function toggleVid() {
  if (playing) {
    vid.pause();
    button.html('play');
  } else {
    vid.loop();
    button.html('pause');
  }
  playing = !playing;
}

function mouseClicked() {
    currentFilter = (currentFilter+1) % filterNames.length;
}