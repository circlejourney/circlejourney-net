var fileArray = ["tree1.jpg", "tree2.jpg", "tree3.jpg","mercury.png","venus.png"];
var imgArray = [];
function preload() {
    for(var i=0; i< fileArray.length; i++) {
        imgArray[i] = loadImage(fileArray[i]);
    }
}


function setup() {
    createCanvas(400,400);
    for(var i=0; i<imgArray.length;i++) {
        image(imgArray[i], (i%3)*100, 50*floor(i/3), 100, 100);
    }
    
}