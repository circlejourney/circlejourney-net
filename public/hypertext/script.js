var storylist, thisStory, currentNode;
var settings = { "storyPath": "stories/", "textInterval": 600 };
var temporary = { "storyBuffer": [] };
var storyCommands = {};

$(document).ready(function(){
    $.getJSON("settings.json", function(data){
        settings = data;
        listStories();
    });
});

function listStories(){
    thisStory = undefined;
    $.getJSON("storyscan.php", data => {

        storylist = Object.values(data).filter(item => item != ".." && item != ".");
        var selectScreen = $("<div></div>").addClass("select-menu");
        
        storylist.forEach((val, i) => {

            $(selectScreen).append(
                $("<div></div>")
                    .html(val)
                    .addClass("user-choice clickable")
                    .click(
                        function(){
                            getStory( settings.storyPath+val );
                            $(this).addClass("selected-choice");
                            $(this).parent().children(".user-choice")
                                .off("click")
                                .removeClass("clickable")
                                .addClass("exhausted-choice");
                        }
                    )
            );

        });
        
        queueMessage(selectScreen, "select");
    });
}

function getStory(url){
    $.getJSON(url).done(data => {
        thisStory = data;
        thisStory.switches = {};
        storyCommands = thisStory.storyCommands;
        queueMessage("Story loaded from "+url+".", "system");
        startStory();
    })
    .fail(() => {
        queueMessage("This story could not be retrieved.", "error");
    });
}


function startStory(){ // Only run this once thisStory is populated.
    accessNode("start");
}

function accessNode(nodeName){
    //try {
        currentNode = thisStory.nodes[nodeName];
        
        var currentText;
        
        if(typeof currentNode.text == "object") currentText = currentNode.text;
        else if(!currentNode.text) currentText = ["..."];
        else currentText = [currentNode.text+""];
        
        
        if(typeof currentText[0] == "object") {
            for(let item of currentText) {
                var condsMet = true;
                
                if(item.required) {
                    for(var cond of item.required){
                        var req = true;
                        if(cond.indexOf("!") === 0) {
                            req = false;
                            cond = cond.substr(1);
                        }
                        
                        if(thisStory.switches[cond] === undefined) thisStory.switches[cond] = false;
                        
                        if(thisStory.switches[cond] != req) {
                            condsMet = false;
                            break;
                        }
                    }
                }
                
                if(condsMet) {
                    currentText = item.text;
                    break;
                }
            }
        }
        
        
        currentText.forEach((val, i) => {
            queueMessage(val)
        });
        
    
        // Selections
        
        if(currentNode.switch) for(let item of currentNode.switch) thisStory.switches[item] = true;
        
        if(currentNode.next) {
            var selectScreen = $("<div></div>").addClass("select-menu");
            currentNode.next.forEach(item => {
                var condsMet = true;
                if(item.required) {
                    for(var cond of item.required) {
                        if(!thisStory.switches[cond]) return false;
                    }
                }
                $(selectScreen).append(
                    $(constructStoryLink(item.target, item.linkText))
                );
            })
            queueMessage(selectScreen, "select");
        } else {
            queueMessage("You have reached the end of the story.", "system");
            listStories();
        }
    //} catch(err) {
        //fatalError("There are errors in the story file.", err);
    //}
}


// CONSCTRUCTION FUNCTIONS

function appendMessage(text, className) {
    let newMessage = $("<div></div>")
        .html(text)
        .addClass(className+" message")
        .css("margin-bottom", "-"+$(".message").css("line-height"));
    $("#display").append(newMessage)
    setTimeout(() => {
        $(newMessage)
            .css("opacity", 1)
            .css("margin-bottom", 0)
    }, 50)
}


function queueMessage(message, className="") {
    var messageObject = {"message": message, "className": className};
    temporary.storyBuffer.push(messageObject);
    if(temporary.timeout === undefined) temporary.timeout = setInterval(() => shiftBuffer(), settings.textInterval);
}

function shiftBuffer() {
    var toDisplay = temporary.storyBuffer.shift();
    appendMessage(toDisplay.message, toDisplay.className);
    if(temporary.storyBuffer.length <= 0) {
        clearInterval(temporary.timeout);
        temporary.timeout = undefined;
    }
}

function constructStoryLink(destinationNodeName, linkText="?") {
    var newLink = $("<div></div>")
        .html(linkText)
        .addClass("user-choice clickable")
        .data("destination", destinationNodeName)
        .click(function() {
            accessNode($(this).data("destination"));
            $(this).addClass("selected-choice");
            $(this).parent().children(".user-choice").off("click").removeClass("clickable").addClass("exhausted-choice");
        });
    return newLink;
}


//COMMANDS

function evalCommand(command) {
    queueMessage(command, "select");
    try {
        let func = command.split(" ");
        let prefix;
        prefix = func[0].indexOf("!") === 0 ? func.shift() : undefined;
        func = func.join(" ");
        
        if(prefix === undefined) return false;
        if(prefix == "!create") {
            let funcParts = func.split("|");
            storyCommands[funcParts[0]] = new Function(funcParts[1]);
            queueMessage("Registered function <b>"+funcParts[0] + "</b> to custom commands. Run it with the command !"+funcParts[0], "system");
        } else {
            storyCommands[prefix.substr(1)]();
            queueMessage("Running command <b>"+prefix+"</b>", "system");
        }
        
    } catch(err) {
            queueMessage(nonfatalError("This command could not be evaluated.", err), "error");
    }
}

//UTILITY

function fatalError(text, error=null) { //for all errors that trigger a full restart
    if(error instanceof Error) text += " ("+error.name+": "+error.message+")";
    appendMessage(text, "error");
    listStories();
}

function nonfatalError(text, error=null) {
    if(error instanceof Error) text += " ("+error.name+": "+error.message+")";
    return text;
}


// LISTENERS

$(window).on("keypress", (e) => {
    if(e.key == "Enter") {
        if($("#response").is(":focus")) {
            evalCommand($("#response").val());
            $("#response").val("");
            e.preventDefault();
        }
    }
});