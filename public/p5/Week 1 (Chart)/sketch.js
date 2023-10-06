var chartBase = 443;
var chartLeft = 63;
var chartRight = 750;
var block1X = chartLeft + 40;
var block3X = 560;
var block2X = (block1X + block3X) / 2;
var barWidth = 45;
var segment = 36.5;
var legendTop = 92;
var legend1X = 230;
var legend3X = 460;
var legend2X = (legend1X + legend3X) / 2;

function stripeRect(barLeft, barHeight) {
  rect(barLeft, chartBase - barHeight * segment, barWidth, barHeight * segment);
  for(var i=0;i<barHeight*10;i++) {
    var lineY = chartBase-i*(segment/10);
    line(barLeft, lineY, barLeft+barWidth, lineY);
  }
}

function setup() {
  createCanvas(768, 475);
}

function draw() {
	var textCol = color(97, 130, 68);
  background(201, 201, 201);

  fill(92, 117, 56);
  textAlign(CENTER);
  textSize(25);
  textStyle(BOLD);
  text("THE COOKIE SHOP", width / 2, 30);
  text("2013 INCOME SUMMARY", width / 2, 60);

  textAlign(LEFT);
  textSize(12);
  text("Total Revenues", legend1X + 15, legendTop);
  text("Total Expenses", legend2X + 15, legendTop);
  text("Profit/Loss", legend3X + 15, legendTop);
  
  textAlign(CENTER);
  text("Oatmeal",block1X+(3*barWidth+20)/2,chartBase+18);
  text("Lemon",block2X+(3*barWidth+20)/2,chartBase+18);
  text("Chocolate",block3X+(3*barWidth+20)/2,chartBase+18);

  noStroke();
  fill(216, 147, 90);
  rect(legend1X, legendTop - 10, 10, 10);
  fill(238, 202, 83)
  rect(legend2X, legendTop - 10, 10, 10);
  fill(146, 178, 122);
  rect(legend3X, legendTop - 10, 10, 10);
  
  textSize(14);
  textAlign(RIGHT);
  fill(textCol);
  
  for (var i = 0; i < 10; i++) {
    stroke(182, 154, 129);
    line(chartLeft, chartBase - i * segment, chartRight, chartBase - i * segment);
    noStroke();
    text("$" + (i * 10000), chartLeft - 8, chartBase - i * segment+5);
  }

  stroke(216, 145, 87);
  fill(247, 188, 141)

  stripeRect(block1X, 8.4);
  stripeRect(block2X, 8.4);
  stripeRect(block3X, 7.55);

  stroke(240, 202, 88);
  fill(253, 228, 123);

  stripeRect(block1X+barWidth+10, 5.7);
  stripeRect(block2X+barWidth+10, 6);
  stripeRect(block3X+barWidth+10, 6.9);

  stroke(154, 200, 111);
  fill(183, 218, 151);

  stripeRect(block1X + 2 * (barWidth+10), 2.5);
  stripeRect(block2X + 2 * (barWidth+10), 2.5);
  stripeRect(block3X + 2 * (barWidth+10), 1.8);
  
}

/*var myimg = document.createElement("img");
myimg.src = "https://i.imgur.com/YN5BCQP.png";
document.body.appendChild(myimg);*/