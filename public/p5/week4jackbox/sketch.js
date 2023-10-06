var boxC, boxO, spring, clown, tile;
var yPos;
var springSize = 0;
var isClosed = true;
var closing = false;
var tileSize;

function preload() {
    boxC = loadImage('box-closed.png');
    boxO = loadImage('box-open.png');
    spring = loadImage('spring.png');
    clown = loadImage('clown-face.png');
    tile = loadImage('wall-tile.jpg');
}

function setup() {
    createCanvas(500, 1000);
    yPos = width/2 - boxO.width/2;
    tileSize = tile.width;
}

function draw() {
    background(255);
    for(var i=0; i<2; i++) {
        for (var j=0;j<4;j++) {
            image(tile, i * tileSize, j * tileSize);
        }
    }
    if(isClosed) {
        image(boxC, yPos+58, spring.height + 200);
        textSize(64);
        text("click me", yPos + 50, 600);
    } else {
        if(closing) {
            console.log(springSize);
            image(boxO, yPos, spring.height+180);
            image(spring, 60+yPos, 280+spring.height - springSize, spring.width, springSize);
            image(clown, yPos, spring.height - springSize + 20);
            if(springSize > 30) springSize -=30;
            else {
                closing = false;
                isClosed = true;
            }
        } else {
            image(boxO, yPos, spring.height+180);
            image(spring, 60+yPos, 280+spring.height - springSize, spring.width, springSize);
            image(clown, yPos, spring.height - springSize + 20);
            if(springSize < spring.height) springSize += 30;
        }
    }
}

function mouseClicked() {
    if(!isClosed) closing = true;
    else isClosed = !isClosed;
}