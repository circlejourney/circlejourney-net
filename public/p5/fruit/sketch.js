let fruits = [];
var florishFiles, faceFiles, mouthFiles, eyesFiles, noseFiles;
var imageFiles;
var wooshRev, tick, tock;
var moving = 0;
var assembled = 0;

var midi, data;

function preload() {
  florishFiles = [
    loadImage("images/Florish1.png")
  ];
  faceFiles = [
    loadImage("images/Face1.png"),
    loadImage("images/Face2.png"),
    loadImage("images/Face3.png"),
    loadImage("images/Face4.png"),
    loadImage("images/Face5.png"),
    loadImage("images/Face6.png"),
    loadImage("images/Face7.png"),
    loadImage("images/Face8.png"),
    loadImage("images/Face9.png"),
    loadImage("images/Face10.png"),
    loadImage("images/Face11.png"),
    loadImage("images/Face12.png")
  ];
  mouthFiles = [
    loadImage("images/Mouth1.png"),
    loadImage("images/Mouth2.png"),
    loadImage("images/Mouth3.png"),
    loadImage("images/Mouth4.png"),
    loadImage("images/Mouth5.png")
  ];
  eyesFiles = [
    loadImage("images/Eyes1.png"),
    loadImage("images/Eyes2.png"),
    loadImage("images/Eyes3.png"),
    loadImage("images/Eyes4.png"),
    loadImage("images/Eyes5.png"),
    loadImage("images/Eyes6.png")
  ];
  noseFiles = [
    loadImage("images/Nose1.png"),
    loadImage("images/Nose2.png"),
    loadImage("images/Nose3.png"),
    loadImage("images/Nose4.png"),
    loadImage("images/Nose5.png")
  ];
  wooshRev = loadSound("audio/woosh-reverb.mp3");
  tick = loadSound("audio/tick.mp3");
  tock = loadSound("audio/tock.mp3");

  // request MIDI access
  if (navigator.requestMIDIAccess) {
      navigator.requestMIDIAccess({
          sysex: false
      }).then(onMIDISuccess, onMIDIFailure);
  } else {
      alert("No MIDI support in your browser.");
  }
}

function setup() {
  createCanvas(1280, 720); // Original size: createCanvas(1920, 1080);
  imageFiles = [
    florishFiles[floor(random(florishFiles.length))],
    faceFiles[floor(random(faceFiles.length))],
    mouthFiles[floor(random(mouthFiles.length))],
    eyesFiles[floor(random(eyesFiles.length))],
    noseFiles[floor(random(noseFiles.length))]
  ];
  
  for(var i=0; i<imageFiles.length; i++) {
      var fruit = new Fruit(
          imageFiles[i],
          921, // Original size: 1843
          540, // Original size: 1080
            random(-1000, width+1000),
            random(-1000, height+1000),
        width/2, height/2,
        random(10,40));
      fruits.push(fruit);
  }
  
  moving = 1;
  assembled = 0;
}

function draw() {
  background(0);
  for(var i=0;i<fruits.length; i++) {
      fruits[i].move(0.05);
  }
  fill(255, 255, 255);
  textSize(18);
  text('Amari Low - Flying Fruit prototype for Griffith University at Beijing Design Week 2018 (click to interact)', 10, 28);
}

class Fruit {
  constructor(img, w, h, x, y, endX, endY, spd) {
    this.w = w;
    this.h = h;
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
    this.img = img;
    this.negX = this.w/2 * -1;
    this.negY = this.h/2 * -1;
    this.stopped = false;
  }

  move(angInc) {
    if(abs(this.x-this.endX) > this.spd/2 && abs(this.y-this.endY) > this.spd/2) {
        this.x += this.spd * this.xRatio;
        this.y += this.spd * this.yRatio;
        if(moving == 1) this.ang += angInc;
        if(!wooshRev.isPlaying() && random() < 0.2) {
          wooshRev.setVolume(random() * 0.8 + 0.2);
          wooshRev.rate(random() * 0.5 + 0.1);
          wooshRev.play();
        }
    } else {
      this.x = this.endX;
      this.y = this.endY;
      if (this.ang > 0 && this.ang <= 2*PI) {
         if(this.ang > PI) this.ang += angInc;
         else this.ang -= angInc;
        if(!tick.isPlaying() && !tock.isPlaying()) {
          if(random() < 0.5) {
            tick.setVolume(random() * 0.8 + 0.2);
            tick.play();
          } else {
            tock.setVolume(random() * 0.8 + 0.2);
            tock.play();
          }
        }
      } else if(!this.stopped) {
          this.stopped = true;
          assembled++;
          if(assembled == fruits.length) {
              if(moving == 1)
                moving = 2;
              else if (moving == 3)
                moving = 0;
          }
      }
    }
    
    if(this.ang > 2 * PI) this.ang = this.ang - 2 * PI;
    
    translate(this.x, this.y);
    rotate(this.ang);
    image(this.img, this.negX, this.negY, this.w, this.h);
    rotate(this.ang * -1);
    translate(this.x * -1, this.y * -1);
  }
  
  explode() {
      this.stopped = false;
      moving = 3;
        this.endX = width/2 + Math.sign(0.5-random()) * (width/2 + random() * 1600);
        this.endY = height/2 + Math.sign(0.5-random()) * (height/2 + random() * 1600);
        this.dY = this.endY - this.y;
        this.dX = this.endX - this.x;
        this.xRatio = this.dX/sqrt(this.dY*this.dY + this.dX*this.dX);
        this.yRatio = this.dY/sqrt(this.dY*this.dY + this.dX*this.dX);
        this.spd = 60;
    }
}

function mouseClicked() {
    if(assembled === fruits.length) {
        if(moving === 0) {
            fruits = [];
            setup();
        } else if(moving === 2) {
            for(var i = 0; i < fruits.length; i++) {
                assembled = 0;
                fruits[i].explode();
            }
        }
    }
}

// midi functions
function onMIDISuccess(midiAccess) {
    // when we get a succesful response, run this code
    midi = midiAccess; // this is our raw MIDI data, inputs, outputs, and sysex status
    var inputs = midi.inputs.values();
    // loop over all available inputs and listen for any MIDI input
    for (var input = inputs.next(); input && !input.done; input = inputs.next()) {
        // each time there is a midi message call the onMIDIMessage function
        input.value.onmidimessage = onMIDIMessage;
    }
}

function onMIDIFailure(error) {
    // when we get a failed response, run this code
    console.log("No access to MIDI devices or your browser doesn't support WebMIDI API. Please use WebMIDIAPIShim " + error);
}

function onMIDIMessage(message) {
    data = message.data; // this gives us our [command/channel, note, velocity] data.
    console.log('MIDI data', data); // MIDI data [144, 63, 73]
    mouseClicked();
}

// not implemented yet
function sendC4Off( midiAccess, portID ) {
  //var noteOnMessage = [0x90, 60, 0xf7]; // note on, middle C, full velocity
  var noteOffMessage = [0x80, 60, 0x00];
  var output = midiAccess.outputs.get(portID);
  output.send( noteOffMessage );  //omitting the timestamp means send immediately.
  //output.send( [0x80, 60, 0x40], window.performance.now() + 1000.0 ); // Inlined array creation- note off, middle C,
                                                                      // release velocity = 64, timestamp = now + 1000ms.
}
