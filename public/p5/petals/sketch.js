var currentChord = 0;
var chords = [["f4", "c5", "e5", "g5"], ['c4', 'g3', 'b4', 'd5'], ["bb3", "f4", "a4", "e5"], ["f3", "bb3", "a4", "c5"]];
var currentBass = 0;
var bass = [["c3", "g3", "b3"], ["bb2", "f3", "c4"], ["c3", "g3", "d4"],  ["bb2", "f3", "e4"]];
var interval = 114;
var portals = [];
var audiocontext;

window.onload = function() {
}

function setup() {
  createCanvas(windowWidth, windowHeight);
  drums = EDrums('x*o*xxo*')
  //synth1 = FM({ maxVoices:4, index:10, cmRatio: 1, attack:ms(1), decay:ms(200) });
  
  synth1 = FM({ maxVoices:4, index:10, cmRatio: 1, attack:ms(1), decay:ms(200) });
  synth2 = FM({ maxVoices:4, index:1, amp: 0.1, attack:ms(100), decay:ms(2000) });
  synth3 = FM({ maxVoices:3, index:1, cmRatio:1, amp:0.9, attack:ms(200), decay:ms(3000)});
  
  r = Reverb({ roomSize: 0.5 });
  synth3.fx.add(r); 
  
  follow = Follow( drums );
  melodyFollow = Follow(synth2);
}

function draw() {
  background(0)
  noStroke();
  fill(255);
  ellipse(width/2, height/2, follow.getValue()*200);
  if(frameCount % interval == 1) {
	  synth3.chord(bass[currentBass]);
	  currentBass = (currentBass+1) % bass.length;
  }
  var col = color(200+55*mouseX/width, 200*mouseX/width, 200, melodyFollow.getValue()*255);
  fill(col);
  rect(0,0,width, height);
  
  fill(255);
	textAlign(CENTER);
  text("Made with p5.gibber.js.", width/2, height/2-80);
  text("Click to play chords: left = low amp modulator, right = high amp modulator; top = soft, bottom = loud", width/2, height/2-60)
  
	for(var i=0; i < portals.length; i++) {
		portals[i].age++;
		if(portals[i].age < 500) {
			if(frameCount%6 === 0 && portals[i].age < 200) {
				portals[i].spawn();
			}
			portals[i].movePetals();
		} else {
			portals.splice(i,1);
		}
	}	
}

function mousePressed() {
    if(!audiocontext) audiocontext = new AudioContext();
    audiocontext.resume();
	synth1.index = 8*mouseX/width;
	synth1.amp = 0.1+0.3*mouseY/height;
	synth2.amp = 0.2+0.2*mouseY/height;
  synth1.chord(chords[currentChord]);
  synth2.chord(chords[currentChord]);
  currentChord = (currentChord+1)%chords.length;
  
  portals.push(new PetalPortal(mouseX, mouseY));
  
}

class Petal {
	constructor(dir) {
		this.x = random()*10-10;
		this.y = random()*10-10;
		this.dir = dir;
		this.age = 0;
	}
	
	move() {
		this.x += cos(this.dir);
		this.y += sin(this.dir);
		this.age++;
		this.dir += 0.05-0.1*random();
	}
	
	paint(parentX, parentY) {
		var col = color(255, 200, 200, map(this.age, 0, 250, 255, 0));
		fill(col)
		ellipse(parentX + this.x, parentY + this.y, 10);
	}
	
	renew() {
		this.age = 0;
		this.x = 0;
		this.y = 0;
	}
}

class PetalPortal {
	constructor (x, y, col = color(255)){
		this.x = x;
		this.y = y;
		this.col = col;
		this.age = 0;
		this.petals = [];
	}
	
	spawn() {
		this.petals.push(new Petal(0.4+random()*(PI-0.8)));
	}
	
	age() {
		this.age++;
	}
	
	movePetals() {
		for(var i = this.petals.length-1; i >= 0; i--) {
			this.petals[i].move();
			this.petals[i].paint(this.x, this.y);
			if(this.petals[i].age >= 250) {
				this.petals.splice(i, 1);
			}
		}
	}
}