/*  Title: map_ev13.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
*/
//<![CDATA[

var tree = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.png', new google.maps.Size (32,32), new google.maps.Point (0,0));
var tree_shadow = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.shadow.png', new google.maps.Size (59, 32), new google.maps.Point (0,0), new google.maps.Point (0,32));

function initialize() {

	var map_center = new google.maps.LatLng(32.725523,-117.252789);
	var markers
	var mapOptions = {
		zoom: 13,
		center: map_center,
		mapTypeId: google.maps.MapTypeId.SATELLITE
		};
	var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	var infoWindow = new google.maps.InfoWindow;

      //function defined below 
      downloadUrl("http://127.0.0.1/wordpress/wp-content/themes/2011_mapdemo/phphandlers/geocode.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("garden_markers");
        for (var i = 0; i < markers.length; i++) {
          var gardenname = markers[i].getAttribute("gardenname");
          var squarefootage= markers[i].getAttribute("squarefootage");
          var description = markers[i].getAttribute("description");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("latitude")),
              parseFloat(markers[i].getAttribute("longitude")));
          var html = "<b>" + gardenname + "</b> <br/>" + "<b>" + squarefootage + "</b> <br/>" + "<b>" + description + "</b>";
	  var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: tree,
            shadow: tree_shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });

/*
        for(var i=0; i<gardens.length; i++) {
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: gardens[i][1],
                visible: true,
		icon: tree,
		shadow: tree_shadow,
		title: gardens[i][0]
            });
	
	var boxText = document.createElement("div");
	
        boxText.style.cssText = "border: 1px solid black; background: #ADD633; color: #003300; margin-top: 8px; font-family: Arial; font-size:12px; font-weight: bold; padding: 5px; border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px;";
       
	boxText.innerHTML = "Garden:  "+ gardens[i][0] + "<br>" + "Description:  " + gardens[i][2] + "<br>" + "Plant:  " + gardens[i][3] + "<br>" + "Planting Date:  " + gardens[i][4] + "<br>" + "Quantity:  " + gardens[i][5];
	infobox_options = {
                        content: boxText
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
                        ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
                        ,infoBoxClearance: new google.maps.Size(1, 1)
                        ,isHidden: false
                        ,pane: "floatPane"
                        ,enableEventPropagation: false
                        };

	infobox = new InfoBox (infobox_options);

	//the event handler is within the for loop
      	google.maps.event.addListener(marker, 'click', (function(marker, i) {
        	return function() {
                    infobox.open(map, marker);
                    map.panTo(gardens[i][1]);	 }
     	 })(marker, i));
//closes the for loop
        }
*/
//closes load
}

//function used to bind shit to infoWindow
function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
}
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


