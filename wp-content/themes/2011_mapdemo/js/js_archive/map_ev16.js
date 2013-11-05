/*  Title: map_ev16.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. 
 *  
 *
*/
//<![CDATA[

var tree = new google.maps.MarkerImage('http://127.0.0.1/wordpress/wp-content/themes/2011_mapdemo/images/tree.png', new google.maps.Size (32,32), new google.maps.Point (0,0));
var tree_shadow = new google.maps.MarkerImage('http://127.0.0.1/wordpress/wp-content/themes/2011_mapdemo/images/tree_shadow.png', new google.maps.Size (59, 32), new google.maps.Point (0,0), new google.maps.Point (0,32));

function initialize() {

	var map_center = new google.maps.LatLng(32.725523,-117.252789);
	var mapOptions = {
		zoom: 13,
		center: map_center,
		disableDefaultUI: true,
		mapTypeId: google.maps.MapTypeId.SATELLITE
		};
	var map = new google.maps.Map(document.getElementById('map'), mapOptions);
      //defining variable arrays outside of the loop
	var gardenname = [];
	var squarefootage = [];
	var description = [];
	var geolocation = [];
	var newMarkers = [];
      //function defined below 
      downloadUrl("http://127.0.0.1/wordpress/wp-content/themes/2011_mapdemo/phphandlers/geocode_display.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("garden_markers");
        for (var i = 0; i < markers.length; i++) {
          var getgardenname = markers[i].getAttribute("gardenname");
          gardenname.push(getgardenname);
          var getsquarefootage = markers[i].getAttribute("squarefootage");
	  squarefootage.push(getsquarefootage);
          var getdescription = markers[i].getAttribute("description");
	  description.push(getdescription);
          var getpoint = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("latitude")),
              parseFloat(markers[i].getAttribute("longitude")));
	  geolocation.push(getpoint);
          var marker = new google.maps.Marker({
            map: map,
            draggable: false,
            position: geolocation[i],
            icon: tree,
            shadow: tree_shadow,
	    title: gardenname[i]
          });
  
	  var boxtext = document.createElement("div");
	  boxtext.id = "infobox";
          boxtext.style.cssText = "border: 1px solid black; background: #ADD633; color: #003300; margin-top: 8px; font-family: Arial; font-size:12px; font-weight: normal; padding: 5px; border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px;";
	  boxtext.innerHTML = "<b>Garden:   </b>" + gardenname [i] + "<br/>" + "<b>Square Footage:  </b>" + squarefootage [i] + "<br/>" + "<b>Description:  </b>" + description [i];
          infobox_options = {
                        content: boxtext 
                        ,disableAutoPan: false
                        ,maxWidth: 0
                        ,pixelOffset: new google.maps.Size(-140, 0)
                        ,zIndex: null
                        ,boxStyle: {
                                background: "url('/wordpress/wp-content/themes/2011_mapdemo/images/tipbox.gif') no-repeat"
                                ,opacity: 0.75
                                ,width: "280px"
                                }
                        ,closeBoxMargin: "12px 4px 2px 2px"
                        ,closeBoxURL: "http://127.0.0.1/wordpress/wp-content/themes/2011_mapdemo/images/close.gif"
                        ,infoBoxClearance: new google.maps.Size(1, 1)
                        ,isHidden: false
                        ,pane: "floatPane"
                        ,enableEventPropagation: false
                        };
	  newMarkers.push(marker);
	  newMarkers[i].infobox = new InfoBox (infobox_options);
	  //newMarkers[i].infobox.open(map, marker);
          //the event handler is within the for loop
	  google.maps.event.addListener(marker, 'click', (function(marker,i){
		return function () {
	  	//newMarkers[i].infobox.close(map,marker);
		map.panTo(geolocation[i]);
	  	newMarkers[i].infobox.open(map, marker);}
	  })(marker,i));
}  //close for loop

});  //close downloadURL function

}  //close initialize function


//function used to call XML file
function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

//]]>


