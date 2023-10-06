var eyeX = 235;
var eyeY = 320;
var eyeRadius = 350;
var triTop = eyeY+20
var triX = 450;
var triHeight = 105;
var bigX = 750;
var bigY = 455;
var rectY = 260;
var rectHeight = 85;
var smallTriHeight = 20;
var tri2left = 600;
var tri2right = 950;
var tri2top = bigY+15;
var blackTriCentre = bigX+120;

function setup() {
  createCanvas(1000, 700);
}

function draw() {
  var bgCol = color(67, 151, 185);
  background(bgCol);
  
  noStroke();
  
  fill(235, 168, 77);
  rect(30,10,150,30);
  
  fill(24, 14, 1);
  triangle(eyeX-150, 100, eyeX+150, 100, eyeX, eyeY);
  triangle(eyeX, eyeY, eyeX-75, 650, eyeX+75, 650);

  
  fill(0,12,25);
	ellipse(eyeX,eyeY,eyeRadius);
  
  col1 = color(11,74,96);
  col2 = color(218,202,187);
  
  for(var i = 0; i < 20; i++) {
    var colNew = lerpColor(col1, col2, i/20);
    fill(colNew);
	  ellipse(eyeX,eyeY,eyeRadius-40-(8*i));
  }
  
  fill(21,32,54);
  ellipse(eyeX,eyeY, 120);

  fill('rgba(24, 14, 1, 0.5)');
  triangle(eyeX-150, 100, eyeX+150, 100, eyeX, eyeY);
  
  fill('rgba(108, 51, 62, 0.5)');
  triangle(eyeX, eyeY, eyeX-75, 650, eyeX+75, 650);
  
  fill(6,6,5);
  triangle(triX, triTop, triX-60, triTop + triHeight, triX+60, triTop + triHeight);
  triangle(triX, triTop + triHeight, triX-50, triTop + triHeight*2, triX+50, triTop + triHeight*2);
  triangle(triX, triTop + triHeight*2, triX-40, triTop + triHeight*3, triX+40, triTop + triHeight*3);
	
  fill(141, 67, 61);
  ellipse(815, 80, 270, 220);

  fill(bgCol);
  ellipse(815, 70, 260, 220);
  
  fill(222, 166, 107);
  ellipse(750, 50, 200, 150);

  fill(bgCol);
  ellipse(750, 50, 200, 130);
  
  rect(600,0,400,50);
  rect(600,0,150,400);
  
  fill(204, 50, 31);
  push();
  translate(640, 110);
  rotate(0.67*PI);
  rect(0,0,70,70);
  
  pop();
  var col3 = color(222, 105, 31);
  var col4 = color(166, 48, 26);
	
    
  for(var i=0; i<30; i++) {
    var newCol = lerpColor(col3, col4, i/30);
    fill(newCol);
	  triangle(bigX, 5, 520+i*4.3, bigY-i*8, bigX, bigY-i*8);
  }
  
  fill(1, 20, 13);
  rect(bigX, rectY, 150, rectHeight);
  fill(184, 47, 16);
  triangle(bigX, rectY, bigX+150, rectY, bigX+150, rectY+rectHeight);
  
  fill(245, 248, 242);
  rect(bigX, rectY+rectHeight+12, 200, 20);
  
  fill(241, 181, 96);
  triangle(bigX, rectY+rectHeight + 40, bigX, rectY+rectHeight+75, bigX+60, rectY+rectHeight+40);
  
  fill(150, 52, 13);
  triangle(bigX, rectY+rectHeight + 75, bigX, bigY, bigX+40, rectY+rectHeight+75);
  
  fill(18, 1, 1);
  triangle(blackTriCentre-40, rectY+rectHeight+45, blackTriCentre+40, rectY+rectHeight+45, blackTriCentre, tri2top);
  
  fill(241, 115, 49);
  triangle(tri2left, tri2top, tri2right, tri2top, (tri2left+tri2right)/2, 650);
  
  fill('rgba(6, 38, 73, 0.9)');
  beginShape();
  vertex(tri2left,750);
  bezierVertex(tri2left+10, 500, tri2right-10, 500, tri2right, 750);
  bezierVertex(tri2right, 560, 600, 560, tri2left, 750);
  endShape();
  
}

/* var myimg = document.createElement("img");
myimg.src = "https://i.imgur.com/oIOmI8v.png";
myimg.style.width = "1000px";
document.body.appendChild(myimg); */