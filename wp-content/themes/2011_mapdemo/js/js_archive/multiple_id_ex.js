function initialize() {
    var secheltLoc = new google.maps.LatLng(49.47216, -123.76307),
         markers,
            myMapOptions = {
             zoom: 13,
            center: secheltLoc,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        map = new google.maps.Map(document.getElementById("map_canvas"), myMapOptions);

    function initMarkers(map, markerData) {
        var newMarkers = [],
            marker;
            
        for(var i=0; i<markerData.length; i++) {
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: markerData[i].latLng,
                visible: true
            }),
            boxText = document.createElement("div"),
            //these are the options for all infoboxes
            infoboxOptions = {
                 content: boxText,
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(-140, 0),
                zIndex: null,
                boxStyle: {
                    background: "url('http:www.garylittle.ca/map/artwork/tipbox.gif') no-repeat",
                    opacity: 0.75,
                    width: "280px"
                },
                closeBoxMargin: "12px 4px 2px 2px",
                closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                infoBoxClearance: new google.maps.Size(1, 1),
                isHidden: false,
                pane: "floatPane",
                enableEventPropagation: false
            };
            
            newMarkers.push(marker);
            //define the text and style for all infoboxes
            boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background:#333; color:#FFF; font-family:Arial; font-size:12px; padding: 5px; border-radius:6px; -webkit-border-radius:6px; -moz-border-radius:6px;";
            boxText.innerHTML = markerData[i].address + "<br>" + markerData[i].state;
            //Define the infobox
            newMarkers[i].infobox = new InfoBox(infoboxOptions);
            //Open box when page is loaded
            newMarkers[i].infobox.open(map, marker);
            //Add event listen, so infobox for marker is opened when user clicks on it.  Notice the return inside the anonymous function - this creates
            //a closure, thereby saving the state of the loop variable i for the new marker.  If we did not return the value from the inner function, 
            //the variable i in the anonymous function would always refer to the last i used, i.e., the last infobox. This pattern (or something that
            //serves the same purpose) is often needed when setting function callbacks inside a for-loop.
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    newMarkers[i].infobox.open(map, this);
                    map.panTo(markerData[i].latLng);
                }
            })(marker, i));
        }
        
        return newMarkers;
    }
    
    //here the call to initMarkers() is made with the necessary data for each marker.  All markers are then returned as an array into the markers variable
    markers = initMarkers(map, [
        { latLng: new google.maps.LatLng(49.47216, -123.76307), address: "Address 1", state: "State 1" },
        { latLng: new google.maps.LatLng(49.47420, -123.75703), address: "Address 2", state: "State 2" },
        { latLng: new google.maps.LatLng(49.47530, -123.78040), address: "Address 3", state: "State 3" }
    ]);
}
