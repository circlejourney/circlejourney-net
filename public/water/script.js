var mymap, markerLayer, addPopup, coordTree;
var editLoc;
var editHold = false;
var markers = [];
var coordList = {};
var follow = false;
var initiated = false;
var firstLoad = true;
var { water_contributorName, water_Follow } = localStorage;

var meIcon = L.icon({
    iconUrl: 'images/marker-icon-yellowsmile.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [-1, -34],
    shadowUrl: 'images/marker-shadow.png',
    shadowSize: [41, 41],
    shadowAnchor: [12, 41]
});

var addIcon = L.icon({
    iconUrl: 'images/marker-redplus.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [-1, -34],
    shadowUrl: 'images/marker-shadow.png',
    shadowSize: [41, 41],
    shadowAnchor: [12, 41]
});

var nearestPopup = L.popup({ offset: [0, -7] })
    .setContent("This is your closest bubbler.");

var editPopupText = $('<div id="post-form">')
    .append('<input type="text" class="contributor" placeholder="Your name" class="main-text-input">')
    .append('<input type="text" class="description" placeholder="A short description" class="main-text-input">')
    .append('<input type="hidden" class="edit-id" value="">')
    .append('<button onclick="postMarker(\'edit\')" id="add-pin-button">Post</button>');

var editPopup = L.popup({offset: [0, 10] }).setContent(editPopupText[0]);

var me = L.marker([0,0], {icon: meIcon})
    .on("click", clearFloatingAdd);
me.refChain = [1];

var addPin = L.marker([0,0], {icon: addIcon})
    .bindPopup(editPopup)
    .on("click", clearFloatingAdd);

// MAIN THREAD
const promise1 = $.getScript("MarkerEntry.js?2");
const promise2 = $.getScript("GPSQuadTree.js?2");
const promise3 = $(document).ready();

Promise.all([promise1, promise2, promise3]).then(function(){
        console.log("Promises complete");

        if(water_contributorName) {
            $("#follow").attr("checked", water_Follow == "true");
        }

        navigator.geolocation.getCurrentPosition(
            function(position){
                initMap([position.coords.latitude, position.coords.longitude]);
            },
            function(){
                me.setOpacity(0);
                initMap([-27.470125, 153.021072]);
                updateMe([-27.470125, 153.021072]);
            },
            {
                timeout: 2000
            }
        );
            
        var watchID = navigator.geolocation.watchPosition(function(position) {
            me.setOpacity(1);
            updateMe([position.coords.latitude, position.coords.longitude]);
        });

        //DOM stuff

        $(".contributor").on("change", function(e) {
            if(!e.target.disabled && e.target.value) {
                localStorage.water_contributorName = e.target.value;
                water_contributorName = e.target.value;
            }
        });

        $("#follow").on("change", toggleFollow);

});


function initMap(coords) {
    
    $.post("hit.php", {"coords": coords});

    mymap = L.map('mymap');
    mymap.on("click", mapClickHandler);
   
   L.tileLayer('https://api.mapbox.com/styles/v1/circlejourney/cl3pwh6nw002214lltauip6es/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2lyY2xlam91cm5leSIsImEiOiJjampoNXdwMXc0enNpM3FyNXZ2cXBuOGZnIn0.HWJyJUmJCi5ReC0_bNDHDw', {
        attribution: 'Map data &copy; <a href="https://www.mapbox.com/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    me.setLatLng(coords).addTo(mymap);
    mymap.setView(coords, 18);
    
}


function mapClickHandler(e) {
    
    if(addPin._map) {
        clearFloatingAdd(e);
        return;
    }

    addPin
        .addTo(mymap)
        .setLatLng(e.latlng);

    me.setOpacity(0.5);
    editHold = true;
    editLoc = [e.latlng.lat, e.latlng.lng];
    editPopup.setLatLng(e.latlng).openOn(mymap);

}

function clearFloatingAdd(e){

    $(editPopupText).find(".contributor").removeAttr("disabled").val(water_contributorName);
    $(editPopupText).find(".description").val("");
    $(editPopupText).find(".edit-id").val("");

    if(addPin._map) {

        addPin.remove();
        me.setOpacity(1);
        editHold = false;
        editLoc = [me.getLatLng().lat, me.getLatLng().lng];

    }

    if(e.sourceTarget._map) {
        editPopup.setLatLng(e.sourceTarget.getLatLng()).openOn(mymap);
    }
}


function fetchCoordList() {

    var rnd = Math.random();
    var newMarkers = [];
    var deletedMarkers = [];
    var workingList;

    $.getJSON("bcc_coords.json?"+rnd, function(bcc_coords){

        workingList = bcc_coords;

    }).then(function(){

        $.getJSON("coords.json?"+rnd, function(coords){
            Object.assign(workingList, coords);

            newMarkers = Object.keys(workingList).filter(function(val){
                return !coordList.hasOwnProperty(val);
            });

            deletedMarkers = Object.keys(coordList).filter(function(val){
                return !workingList.hasOwnProperty(val);
            });
            
            coordList = workingList;

            if(newMarkers.length > 0 || deletedMarkers.length > 0) {

                coordListToTree();

                try {

                    newMarkers.forEach(function(val, i){
                        let marker = coordList[val];
                        markers[val] = new markerEntry(marker.coords[0], marker.coords[1], val, marker.description, marker.contributor);
                        markers[val].bindPopup();
                    });

                    deletedMarkers.forEach(function(val, i){
                        markers[val].shape.remove();
                        delete markers[val];
                    })

                } catch(err) {
                    console.log(err);
                }

            }

            me.refChain = GPSQT.findRefChain(coordTree, me.getLatLng().lat, me.getLatLng().lng);

        })
    });

}

function addData(dataObject) {
    let existingKeys = Object.keys(coordList);
    let newMarkers = [];
    for(const [k, v] of Object.entries(dataObject)) {
        if(existingKeys.indexOf(k) == -1) {
            coordList[k] = v;
            newMarkers.push(v);
        }
    }
    return newMarkers;
}

function coordListToTree() {

    var tree = [];

    for(var [k, v] of Object.entries(coordList)) {
        tree.push(v);
    }

    coordTree = GPSQT.mkTree(tree, -180, 180, -90, 90);

}

function updateMe(coords) {

    me.setLatLng(coords);
    if(!editHold) editLoc = coords;
    if($("#follow").prop("checked")) mymap.setView(coords);
    fetchCoordList();

}

function postMarker(action) {

    $.post("submit.php", {
        "action": action,
        "contributor": $(".contributor").val() || "Anonymous user",
        "description": $(".description").val() || "Fountain",
        "editID": $(".edit-id").val(),
        "lat": editLoc[0],
        "lng": editLoc[1],
        "time": Math.round( Date.now() / 1000 )
    }, function(data){
        console.log(data);
        editHold = false;
        $(".contributor").removeAttr("disabled");
        $(".contributor").val(water_contributorName);
        $(".description").val("");
        fetchCoordList();
    });

}


function toggleFollow(e) {
    localStorage.water_Follow = e.target.checked;
}


function findNearest(coords) {
    let refChain = me.refChain;

    var searchList = coordTree;
    for(i=0; i<refChain.length; i++) {
        if(searchList[refChain[i]].length > 0) { 
            searchList = searchList[refChain[i]];
        } else {
            break;
        }
    }
    searchList = GPSQT.concatTree(searchList);
    
    searchList.sort(function(a, b){
        return distance(a.coords, coords) - distance(b.coords, coords);
    });

    mymap.setView( searchList[0].coords );
    nearestPopup.setLatLng( searchList[0].coords ).openOn(mymap);
    return searchList[0];

}

function findNearestLinear(coords) {

    var searchList = Object.keys(coordList).sort( function(a, b){
        return distance(coordList[a].coords, coords) - distance(coordList[b].coords, coords);
    } );

    mymap.setView( coordList[searchList[0]].coords );
    nearestPopup.setLatLng( coordList[searchList[0]].coords ).openOn(mymap);

}


function distance(coords1, coords2) {

    return Math.sqrt( Math.pow(coords2[0] - coords1[0], 2) + Math.pow(coords2[1] - coords1[1], 2) );

}

function toggleInfo() {
    $(".info-display").toggleClass("hidden");
}