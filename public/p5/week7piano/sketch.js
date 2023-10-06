var music;
var playMode = 'restart';

function preload() {
    music = loadSound('audio/piano.mp3');
}

function setup() {
  createCanvas(200, 200);
  background(150);
  text("Press 'space' to play and 's' to stop", 10, height/2);
}

function keyTyped() {
    console.log(key);
    switch(key) {
        case ' ':
            music.stop();
            music.play();
            break;
        case 's':
            music.stop();
            break;
        case 'v':
            music.setVolume(random());
            break;
        case 'p':
            if (music.isPaused()) {
                music.play();
            } else {
                music.pause();
            }
        case 'r':
            music.rate(random() + 0.5); 
            break;
        case 'l':
            if (music.isLooping()) {
                music.setLoop(false);
            } else {
                music.setLoop(true);
            }
        case 'n':
            music.pan(random() * 2 - 1);
            break;
        case 'j':
            var dur = music.duration();
            music.jump(random() * dur);
            break;
        
    }
}

