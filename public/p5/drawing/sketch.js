var brush;

function diag(o, a) {
  return sqrt(pow(o, 2) + pow(a, 2));
}

function Brush(shape, size, col) {
  this.col = col;
  this.smooth = 0.2;
  this.size = size;
  this.shape = shape;
  this.isDown = false;
  this.angle = 0;

  this.paint = function() {
    if (this.isDown && mouseX < 400) {
      fill(this.col);
      dX = mouseX - this.x;
      dY = mouseY - this.y;
	  this.angle = atan(dY/dX);
      thin = 1 + diag(dX, dY) / 4;
      var newX = this.x + dX * this.smooth;
      var newY = this.y + dY * this.smooth;
      noStroke();
	  switch(this.shape) {
		  case "tri":
			stroke(this.col);
			/*strokeWeight(1);
			//line(newX + this.size / thin, newY - this.size / thin, newX - this.size / thin, newY + this.size / thin);
			var xExt = (this.size/2)*cos(this.angle-PI/2)/thin;
			var yExt = (this.size/2)*sin(this.angle-PI/2)/thin;
			
			line(newX - xExt, newY - yExt, newX + xExt, newY + yExt);*/
			
			strokeCap(SQUARE);
			strokeWeight(this.size/thin);
			stroke(this.col);
			line(this.x, this.y, newX, newY);
			break;
			
			break;
		  case "bucket":
			rect(0,0,400,400);
			break;
		  case "circle":
			strokeCap(ROUND);
			strokeWeight(this.size/2+this.size/(2*thin));
			stroke(this.col);
			line(this.x, this.y, newX, newY);
			break;
		case "clear":
		    fill(255);
			rect(0,0,400,400);
			break;
		case "picker":
			var prevBrush = this.shape;
			var pix = get(mouseX, mouseY);
			this.col = color(pix[0],pix[1],pix[2]);
			this.shape = prevBrush;
			break;
		case "airbrush":
			for(var i=0;i<5;i++) {
				dotAngle = random(0,2*PI);
				dist = random(0,this.size);
				stroke(this.col);
				point(newX + sin(dotAngle)*dist/2, newY + cos(dotAngle)*dist/2);
			}
			break;
			
	  }
      this.x = newX;
      this.y = newY;
    } else {
      this.x = mouseX;
      this.y = mouseY;
      this.isDown = true;
    }
  }

  this.lift = function() {
    this.isDown = false;
  }
  
  this.drawBrush = function() {
      dX = mouseX - this.x;
      dY = mouseY - this.y;
	  this.angle = atan(dY/dX);
			strokeWeight(1);
	  switch(this.shape) {
		  case "tri":
			stroke(this.col);
			//line(mouseX, mouseY - this.size, mouseX - this.size, mouseY + this.size);
			var xExt = (this.size/2)*cos(this.angle-PI/2);
			var yExt = (this.size/2)*sin(this.angle-PI/2);
			line(mouseX - xExt, mouseY - yExt, mouseX + xExt, mouseY + yExt);
			break;
		  case "bucket":
			//drawbucket
			break;
		  case "circle":
			stroke(this.col);
			noFill();
			ellipse(mouseX, mouseY, this.size);
			break;
		  case "airbrush":
			stroke(this.col);
			noFill();
			ellipse(mouseX, mouseY, this.size);
			break;
		case "picker":
			//drawpicker
	  }
  }
}

function Button(x,y,label,shape,active = false) {
  this.x = x;
  this.y = y;
  this.label = label;
  this.shape = shape;
  this.active = active;
  this.render = function() {
    noStroke();
    this.active ? fill(150) : fill(200);
    rect(x-30,y-30,60,60);
	
    fill(0);
    textAlign(CENTER);
    textSize(14);
    text(label,x,y);
  }
  buttons[shape] = this;
  
  this.hit = function() {
		for(var key in buttons){
		buttons[key].active = false;
		brush.shape = this.shape;
		this.active = true;
	  }
  }
}

function Slider(brushProp, y) {
	this.brushProp = brushProp;
	this.x = 400;
	this.y = y;
	this.h = 20;
	this.isDown = false;
	this.render = function() {
		fill(200);
		rect(this.x, this.y, 255, this.h);
		stroke(100);
		strokeCap(SQUARE);
		strokeWeight(2);
		line(this.x+brush[this.brushProp], this.y, this.x+brush[this.brushProp], this.y + this.h);
	}
	
	this.set = function() {
		brush[brushProp] = mouseX - this.x;
	}
}

var buttons = {};
var snap;
var sizeSlider;

function setup() {
  createCanvas(660, 400);
  background(255);
  fill(0);
  new Button(440,240,"Fill","bucket");
  new Button(530,240,"Round","circle");
  new Button(620,240,"Calligraphy","tri",true);
  new Button(440,310,"Clear","clear");
  new Button(530,310,"Picker","picker");
  new Button(620,310,"Airbrush","airbrush");
  
  brush = new Brush("tri", 5, color(0));
  
  sizeSlider = new Slider("size", 350);
  
  for (var i = 0; i < 255; i++) {
    for (var j = 0; j < 50; j++) {
      colorMode(HSB);
      stroke(i, j*2, 100);
      point(400 + i, j);
    }
    for (var k = 0; k < 50; k++) {
      colorMode(HSB)
      stroke(i, 100, 100-k*2);
      point(400 + i, 50+k);
    }
  }
}

function draw() {
	//load snapshot to remove brush shape
	updatePixels();
  
  //draw UI elements
  colorMode(RGB, 255);
  noStroke();
  fill(brush.col);
  rect(400, 100, 255, 100);
  
  sizeSlider.render();
  
  for(var key in buttons) {
    buttons[key].render();
  }
  if(mouseX <= 400-brush.size/2) {
	if (mouseIsPressed) {
		brush.paint();
	}
	snap = loadPixels();
	brush.drawBrush();
  } else {
	  if(mouseIsPressed && mouseX > sizeSlider.x && mouseX < sizeSlider.x+255 && mouseY > sizeSlider.y && mouseY < sizeSlider.y + sizeSlider.h) {
		sizeSlider.set();
	  }
  }
}

function mouseClicked() {
  if (mouseX > 400 && mouseY < 200) {
    var sample = get(mouseX, mouseY);
    colorMode(RGB,255);
    brush.col = color(sample[0], sample[1], sample[2]);
    
  } 
  else {
    for(var key in buttons) {
		if (mouseX > buttons[key].x-40 && mouseX <  buttons[key].x + 40 && mouseY > buttons[key].y-40 && mouseY < buttons[key].y+40) {
			buttons[key].hit();
		}
    }
  }
}

function mouseReleased() {
  brush.isDown = false;
  sizeSlider.isDown = false;
}