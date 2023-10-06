var init = 0;
var coords;
var radius = 0.004;
var story;
var stories;
var cookies = false;
var lastLoc = "not set";
var ring = document.createElement("audio");
var geolocOn = false;
ring.src = location.pathname+"bell.mp3";

var playerData = {
    story: "not set",
    currentNode: -1
}

function log(msg) {
    console.log(msg);
    logmsg(msg);
}

function getStorage(){
    try {
        var tempdata = localStorage.brisbaneGame.split(";");
        playerData.story = tempdata[0];
        playerData.currentNode = parseInt(tempdata[1]);
        cookies = tempdata[2] == "true" ? true : false;
    } catch(err) {}
}

function updateStorage(story, currentNode) {
    localStorage.brisbaneGame = playerData.story+";"+playerData.currentNode+";"+cookies;
}

function acceptCookies(){
    $("#cookies").remove();
    cookies = true;
    updateStorage();
}

function storySelect(){
    log("Opening select screen")
    var messageDeck = document.createElement("div");
    var keys = Object.keys(stories);
    for(var i=0; i<keys.length; i+=3) {
        message = document.createElement("div");
        message.className = "card-deck mb-4";
        for(var j=0;j<3;j++) {
            if(keys[i+j] != undefined) {
            var btn = document.createElement("div");
            btn.className = "card interactable p-0";
            var thumb = document.createElement("img");
            thumb.className = "card-img-top";
            thumb.src= "images/" + keys[i+j] + ".jpg";
            btn.append(thumb);
            var label = document.createElement("div");
            label.className = "card-body text-center text-dark";
            label.innerHTML = stories[keys[i+j]].alias;
            btn.append(label);
            btn.dataset.story = keys[i+j];
            btn.onclick = function() { startStory(this.dataset.story) };
            message.append(btn);
            } else {
                var div = document.createElement("div");
                div.style.opacity="0";
                div.className="card";
                message.append(div);
            }
        messageDeck.append(message)
        }
    }
    $("#storylog").html("<p>Select a story to begin:</p>");
    $("#storylog").append(messageDeck);
    $("#nextmsg").text("");
}

function startOver() {
    playerData = {
        story: "not set",
        currentNode: -1
    }
    updateStorage();
    $.getJSON("stories.json", function(data){
        stories = data;
        storySelect();
    });
}

function startStory(storyname){
    playerData.story = stories[storyname].story;
    playerData.currentNode = -1;
    lastLoc = "not set";
    updateStorage();
    log("You have begun the story "+storyname+".");
    
    $.getJSON(location.pathname+playerData.story+".json", function(data){
        log("Loaded "+playerData.story+".json");
        story = data;
        var message = "";
        message += "<p>Begin the story <i>"+stories[storyname].alias+"</i></p>";
        if(stories[storyname].warning) {
            message+= "<p>"+stories[storyname].warning+"</p>";
        }
        updateStory(message);
        nextMsg();
        navigator.geolocation.getCurrentPosition(updateLoc);
    });
}

function logmsg(msg) {
    $("#log").append("<p>"+msg+"</p>")
}

function updateStory(msg) {
    $("#storylog").html(msg);
}

function nextMsg(msg){
    var message = msg || "Go to " + story[playerData.currentNode+1].loc + " to access the next piece of the story."
    $("#nextmsg").html(message);
    logmsg(message);
}

function getDist(latlon1, latlon2) {
    var h = latlon2[0] - latlon1[0];
    var v = latlon2[1] - latlon1[1];
    return Math.sqrt(h*h+v*v);
}


//MAIN FUNCTION

function updateLoc(data) {
    log("Updating location...");
    geolocOn = true;
    if(init >= 3) {
        var latlon=[data.coords.latitude, data.coords.longitude];
        var currentLoc = "not set";
        
        $.each(coords, function(i, val){
            coords[i].dist = getDist(latlon, val.latlon);
        });
        
        coords.sort(function(a, b){
            return a.dist - b.dist;
        });
        
        $.each(coords, function(i, val){
            if(val.dist < radius) {
                currentLoc = val.name;
                return false;
            }
        });
        
        var d = new Date;
        logmsg("Distance from "+ coords[0].name +" at "+d.toTimeString()+": "+coords[0].dist);
        
        if(playerData.story != "not set") {
            if(currentLoc != lastLoc) {
                if(currentLoc == "not set") {
                    logmsg("You are not at a story node.");
                    lastLoc = "not set";
                } else if(currentLoc != lastLoc) {
                    logmsg("You are at the " + currentLoc + " story node.");
                    if(currentLoc == story[playerData.currentNode+1].loc) {
                        playerData.currentNode++;
                        ring.play();
                    }
                    if(playerData.currentNode>-1){
                        updateStory(story[playerData.currentNode].text);
                    }
                }
                lastLoc = currentLoc;
            }
            
            try {
                if(story[playerData.currentNode].custommovetext) {
                    nextMsg(story[playerData.currentNode].custommovetext);
                } else if(playerData.currentNode >= story.length-2){
                    nextMsg("End. <a href='#' onclick='storySelect()'>Tap here to start a new story</a>");
                } else nextMsg();
            } catch {
                nextMsg();
            }
        } else {
            storySelect();
        }
    }
}

//DEBUG TOOLS

function stepForward() {
    if(playerData.story != "not set") {
        playerData.currentNode++;
        if(playerData.currentNode>-1){
            ring.play();
            updateStory(story[playerData.currentNode].text);
        }
        try {
            if(story[playerData.currentNode].custommovetext) {
                nextMsg(story[playerData.currentNode].custommovetext);
            } else if(playerData.currentNode >= story.length-2){
                nextMsg("End. <a href='#' onclick='storySelect()'>Tap here to start a new story</a>");
            } else nextMsg();
        } catch {
            nextMsg();
        }
        updateStorage();
    }
}

function showCoords() {
$("#coordspace").html(latlon.toString());
}

//ON STARTUP

getStorage();

//load location coordinates list
$.getJSON(location.pathname+"coords.json", function(data){
    log("Coordinates list loaded")
    coords = data;
    init++;
    navigator.geolocation.getCurrentPosition(updateLoc);
});

//load list of stories
$.getJSON(location.pathname+"stories.json", function(data){
    log("Story list file loaded");
    stories = data;
    init++;
    navigator.geolocation.getCurrentPosition(updateLoc);
});

//If player has started a story previously, load story map
if(playerData.story != "not set") {
    log("Player has previously started "+playerData.story);
    $.ajax({
        url: location.pathname+playerData.story+".json"
    }).done(function(data){
        log(playerData.story+" story map loaded");
        story = data;
        init++;
        navigator.geolocation.getCurrentPosition(updateLoc);
    });
} else {
    log("Player has not chosen a story");
    init++;
    navigator.geolocation.getCurrentPosition(updateLoc);
}

//on document load

$(document).ready(function(){
    var timeout = setTimeout(function(){
        if(!geolocOn){
            location.href=location.href;
        }
    },20000);
    var alertMsg = '<div class="alert alert-warning m-3" id="cookies">This website uses cookies to save your progress. By continuing, you agree to allow this website to record your game progress in your browser\'s local storage. <a onclick="acceptCookies()" class="btn btn-primary text-white ml-2">Got it</a></div>';
    if(!cookies) $("#main").before(alertMsg);
    log("Ready.");
    navigator.geolocation.watchPosition(updateLoc);
});