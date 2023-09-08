class markerEntry {
    constructor(lat, lng, id, description, contributor, timeUpdated) {
        this.lat = lat;
        this.lng = lng;
        this.id = id;
        this.description = description;
        this.contributor = contributor;
        this.timeUpdated = timeUpdated;
        this.shape = L.circleMarker([lat, lng], {radius: 10})
            .setStyle( { color: "#6a2de3" } )
            .addTo(mymap)
            .on("click", clearFloatingAdd);
    }

    editThis() {

        editLoc = [this.lat, this.lng];
        editHold = true;
        editPopup.setLatLng(editLoc).openOn(mymap);
        $(".contributor")
            .attr("disabled", "true")
            .val(this.contributor);
        $(".description").val(this.description);
        $(".edit-id").val(this.id);
        console.log("Editing "+this.id);

    }

    bindPopup() {

        let popupElement = $( "<div class='pin-wrapper'></div>" )
            .append(
                $("<div class='pin-text'>")
                    .append("<p class='pin-title'><b>"+this.description+"</b></p>")
                    .append("<p class='pin-body'>Source: "+this.contributor+"</p>")
            )
            .append(
                $("<div class='pin-button'></div>")
                    .append(
                        $("<button>&#x270e;</button>").on( "click", function(){ this.editThis() }.bind(this) )
                    )
            );

        this.shape.bindPopup( popupElement[0] );

    }
}