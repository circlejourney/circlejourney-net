function pickRandomFrom(array) {
return array[Math.floor(array.length*Math.random())]
}

function cleanArray(array) {
var i=0;
while(i<array.length) {
if(array[i]=="") {
array.splice(i,1);
} else {
i++;
}
}
}

function getPositionsOf(item,array) {
positionArray = [];
$.each(array,function(a,b) {
if(b==item) {
positionArray.push(a);
}
});
return positionArray;
}

function repeatFunction(fn,times) {
for(var i=0;i<times;i++) fn();
}

function randInt(min,max) {
return min + Math.floor(Math.random()*(max-min+1));
}

function removeRepeats(array) {
var arrayObj = {};
$.each(array,function(a,b) {
arrayObj[b]=1;
});
return Object.keys(arrayObj);
}

function weightedRandom(weightObject) { // {option: weight, option: weight}
var compare = 0;
$.each(weightObject, function(a,b) {compare += b;});
var rand = Math.random()*compare;
for(var prop in weightObject) {
rand-=weightObject[prop];
if(rand<=0) {
return prop;
}
}
}

function freqSort(freqObject,order) {
ranking = [];
newRanking = {};
for (var prop in freqObject) {
ranking.push(freqObject[prop]);
}
ranking = ranking.sort(function(a,b){return a-b});
for(var i=ranking.length-1;i>=0;i--) {
for(var prop in freqObject) {
if (freqObject[prop]==ranking[i]) {
newRanking[prop] = freqObject[prop];
delete freqObject[prop];
break;
}
}
}
console.log(newRanking);
return newRanking;
}


myKeys = {backspace: 8,tab: 9,enter: 13,shift: 16,ctrl: 17,alt: 18,break: 19,capslock: 20,escape: 27,pageup: 33,pagedown: 34,end: 35,home: 36,left: 37,up: 38,right: 39,down: 40,insert: 45,delete: 46,0: 48,1: 49,2: 50,3: 51,4: 52,5: 53,6: 54,7: 55,8: 56,9: 57,a: 65,b: 66,c: 67,d: 68,e: 69,f: 70,g: 71,h: 72,i: 73,j: 74,k: 75,l: 76,m: 77,n: 78,o: 79,p: 80,q: 81,r: 82,s: 83,t: 84,u: 85,v: 86,w: 87,x: 88,y: 89,z: 90,numpad0: 96,numpad1: 97,numpad2: 98,numpad3: 99,numpad4: 100,numpad5: 101,numpad6: 102,numpad7: 103,numpad8: 104,numpad9: 105,multiply: 106,add: 107,subtract: 109,decimalpoint: 110,divide: 111,f1: 112,f2: 113,f3: 114,f4: 115,f5: 116,f6: 117,f7: 118,f8: 119,f9: 120,f10: 121,f11: 122,f12: 123,numlock: 144,scrolllock: 145,semicolon: 186,equal: 187,comma: 188,dash: 189,fullstop: 190,slash: 191,accent: 192,openbracket: 219,backslash: 220,closebracket: 221,quote: 222,};

function removeFromArray(myarray,removeitem) {
for(var i=myarray.length-1;i>=0;i--){
if(myarray[i]==removeitem) {
myarray.splice(i);
}
}
return myarray;
}

function getElementsByProp(prop,val) {
var myElems = [];
$.each(document.getElementsByTagName("*"),function(a,b){
if(b[prop]==val) {
myElems.push(b);
}
});
if(myElems.length==1) {
myElems = myElems[0];
}
return myElems;
}

console.log("myLibrary.js loaded successfully");