var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
var flags = {};
var nameInput;

function preload() {
    for(var i=0; i<alphabet.length; i++) {
        flags[alphabet[i]] = loadImage("flags/"+alphabet[i]+".png");
    }
    
}
function setup() {
  nameInput = createInput("Circlejourney");
  nameInput.input(updateFlags);
  nameInput.id("input");
  nameInput.class("form-control");
  nameInput.parent("input-div")
    canv = createCanvas(500, 800);
    canv.parent("mycanvas");
    canv.id("canvas");
  updateFlags();
}

function draw() {
  
}

function updateFlags() {
    var inp = nameInput.value();
    inp = inp.toUpperCase();
    inp = inp.replace(/\W/g, "");
    inpArray = inp.split("_");
    clear();
    var longest = inpArray.reduce(
        function (a, b) {
            return a.length > b.length ? a : b;
        }
    );
    
    for(var i=0; i<inpArray.length; i++) {
        var j;
        for(j=0; j<inpArray[i].length; j++) {
            image(flags[inpArray[i][j]], i*42+width/2-inpArray.length*21, j*42+height/2-longest.length*21, 50, 50);
        }
        if(j>longest) longest=j;
    }
}