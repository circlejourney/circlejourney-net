var title = "Spin";
var author = "Amari Low";
var col1;
var col2;
var wheelCentre = [275, 350];
var wheelDiam = 350;
var axleRad = 12;

function spaceText(mytext, sideSpacing, topSpacing) {
  var leftSpacing = sideSpacing;
  var rightSpacing = width - sideSpacing;
  var charSpace = (rightSpacing - leftSpacing) / (mytext.length - 1);
  for (var i = 0; i < mytext.length; i++) {
    text(mytext[i].toUpperCase(), leftSpacing + i * charSpace, topSpacing);
  }
}

function setup() {
  createCanvas(550, 750);
  col1 = color(66, 134, 244);
  col2 = color(146, 221, 219);

}

function draw() {
  background(col2);
  for (var i = 0; i < height; i++) {
    stroke(lerpColor(col1, col2, i / height));
    line(0, i + 1, width, i + 1);
  }

  //lines

  for (var i = 0; i < height * 2; i++) {
    strokeWeight(1);
    stroke('rgba(168, 226, 255,0.5)');
    line(0, i * 10, i * 10, 0);
  }

  //beam
  fill(183, 238, 247);
  rect(width / 2 - 80, 0, 160, height);
  rect(width / 2 - 95, 0, 10, height);
  rect(width / 2 + 85, 0, 10, height);
  rect(width / 2 - 105, 0, 3, height);
  rect(width / 2 + 102, 0, 3, height);

  //mountains

  noStroke();

  fill(120, 170, 210);
  triangle(width * 0.1, height, width * 0.27, height - 100, width * 0.5, height);
  triangle(width * 0.48, height, width * 0.65, height - 120, width * 0.83, height);

  fill(100, 130, 190);
  triangle(0, height, width * 0.13, height - 100, width * 0.3, height);
  triangle(width * 0.2, height, width * 0.47, height - 180, width * 0.7, height);
  triangle(width * 0.3, height, width * 0.57, height - 140, width * 0.79, height);
  triangle(width * 0.64, height, width * 0.77, height - 100, width * 0.95, height);
  triangle(width * 0.8, height, width * 0.9, height - 50, width, height);


  //text


  fill(50, 70, 140);
  textAlign(CENTER);
  textFont("Helvetica");
  textStyle(BOLD);
  textSize(90);

  spaceText(title, 70, 90);
  
  stroke(50,70, 140);
  line(45, 105, width-45, 105);

  //fill(30, 50, 100);
  textStyle(NORMAL);
  textSize(30);
  spaceText(author, 60, 140);

  //wheel

  for (var i = 0; i < 12; i++) {
    fill(22 * i, 70, 140);
    noStroke();
    var angle = (2 * i + 1) * PI / 12;
    var displace = [Math.cos(angle) * axleRad, Math.sin(angle) * axleRad];
    arc(wheelCentre[0] + displace[0], wheelCentre[1] + displace[1], wheelDiam, wheelDiam, i * PI / 6, (i + 1) * PI / 6);
  }

}

function mouseClicked() {
  console.log(mouseX + "," + mouseY);
}