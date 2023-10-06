var capture, temp, tempdeg, black, white, val, snapshot, img, cap;
var droppedImage = false;
var colthreshold = 150;

function setup() {
    frameRate(12);
    var canvas = createCanvas(320, 240);
    canvas.parent('sketch');
    capture = createCapture(VIDEO);
    capture.size(320, 240);
    capture.parent("sketch");
    canvas.drop(gotFile);
}

function draw() {
      black = parseInt($("#black").val());
      white = parseInt($("#white").val());
      temp = parseInt($("#temp").val());
      tempdeg = abs(temp-128);
      val =  parseInt($("#val").val());
      
      if(!droppedImage) {
          capture.loadPixels();
          for(var i=0;i<width;i++) {
              for(var j=0;j<height;j++) {
                  var ref = 4*(j*width+i);
                  var avg = (capture.pixels[ref]+capture.pixels[ref+1]+capture.pixels[ref+2])/3;
                  
                  var RGB = [0,0,0];
                  $.each(RGB, function(l, val){
                      RGB[l] = capture.pixels[ref + l] + (100-white);
                  });
                  
                  if(avg < black) {
                      capture.set(i, j, color(0));
                  } else if(avg < black + (255 - black) * white / 100) {
                        var newRGB = [val,val,val];
                        
                        if(temp > 128) newRGB[2] += tempdeg;
                        else {
                            newRGB[0] += tempdeg/2;
                            newRGB[1] += tempdeg/2;
                        }
                        
                        $.each(RGB, function(m, val){
                            if(RGB[m] > colthreshold) newRGB[m] = 255;
                        });
                        
                        capture.set(i, j, color(newRGB));
                  } else {
                      capture.set(i, j, color(255));
                  }
              }
          }
          capture.updatePixels();
          image(capture, 0, 0);
      } else {
          image(img, 0, 0, width, height);
          cap = get();
          cap.loadPixels();
          
          for(var i=0;i<width;i++) {
              for(var j=0;j<height;j++) {
                  var ref = 4*(j*width+i);
                  var avg = (cap.pixels[ref]+cap.pixels[ref+1]+cap.pixels[ref+2])/3;
                  
                  var RGB = [0,0,0];
                  $.each(RGB, function(l, val){
                      RGB[l] = cap.pixels[ref + l] + (100-white);
                  });
                  
                  if(avg < black) {
                      cap.set(i, j, color(0));
                  } else if(avg < black + (255 - black) * white / 100) {
                        var newRGB = [val,val,val];
                        
                        if(temp > 128) newRGB[2] += tempdeg;
                        else {
                            newRGB[0] += tempdeg/2;
                            newRGB[1] += tempdeg/2;
                        }
                        
                        $.each(RGB, function(m, val){
                            if(RGB[m] > colthreshold) newRGB[m] = 255;
                        });
                        
                        cap.set(i, j, color(newRGB));
                  } else {
                      cap.set(i, j, color(255));
                  }
              }
          }
          cap.updatePixels();
          image(cap, 0, 0);
      }
}

function gotFile(file) {
  // If it's an image file
  if (file.type === 'image') {
      droppedImage = true;
    // Create an image DOM element but don't show it
    img = createImg(file.data);
    img.hide();
    // Draw the image onto the canvas
    image(img, 0, 0, width, height);
  } else {
    println('Not an image file!');
  }
}

window.onload = function() {
    document.getElementById("snap").onclick = function() {
        snapshot = get();
        save(snapshot, "snapshot.jpg")
  }
}