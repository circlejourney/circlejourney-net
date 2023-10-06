var components = {current: []};
var images = {};
var order = ["neck", "face", "mouth", "eyes", "eyebrows"];

components.face = ["chiselled", "heart", "oval", "round", "square"];
components.neck = ["thin", "med", "thick"];
components.mouth = ["neutral", "smallsmile", "smile", "bigsmile", "grin", "lopsided", "laugh", "gasp", "smallfrown", "frown"];
components.eyes = [ "cute", "fierce", "halflid", "hero", "narrow", "ojou", "princess", "round", "semi", "shy"];
components.eyebrows = ["angry", "determined", "doubtful", "neutral", "surprised"];
    
function preload() {
    $.each(order, function(i, val) {
        var styles = components[val];
        images[val] = [];
        $.each(styles, function(j, val2) {
            images[val].push(loadImage(val+"/"+val+"-"+val2+".png"));
        });
    });
}

function setup() {
    var mycanvas = createCanvas(400, 400).elt;
    var ctx = mycanvas.getContext("2d");
    ctx.imageSmoothingEnabled = false;
    imageMode(CENTER);
    components.current = [];
    randomFace();
}

function draw() {
    background(255);
  $.each(components.current, function(i, val) {
      image(val, width/2, height/2);
  })
}

function randomFace() {
    $.each(order, function(i, val) {
        components.current.push(images[val][floor(random(images[val].length))]);
    });
}