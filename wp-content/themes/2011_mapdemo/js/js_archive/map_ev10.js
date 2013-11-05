/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/

//declaring an array of static garden locations
var gardens = [["Garden A", new google.maps.LatLng(32.729000, -117.250000),  "This is content for Garden A",  "Avocados",  "12/12/2012", "5"],[ "Garden B", new google.maps.LatLng(32.725000, -117.253000),  "This is content for Garden B", "Squash", "12/13/2012", "10"]]; 

function initialize() {

	var map_center = new google.maps.LatLng(32.725523,-117.252789);
	var markers
	var mapOptions = {
		zoom: 13,
		center: map_center,
		mapTypeId: google.maps.MapTypeId.SATELLITE
		};

	var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	//setting options for the infobox
        infobox_options = {
			disableAutoPan: false
                        ,maxWidth: 0
                        ,pixelOffset: new google.maps.Size(-140, 0)
                        ,zIndex: null
                        ,boxStyle: {
                                background: "url('/wordpress/wp-content/themes/2011_mapdemo/images/tipbox.gif') no-repeat"
                                ,opacity: 0.75
                                ,width: "280px"
                                }
                        ,closeBoxMargin: "10px 2px 2px 2px"
                        ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
                        ,infoBoxClearance: new google.maps.Size(1, 1)
                        ,isHidden: false
                        ,pane: "floatPane"
                        ,enableEventPropagation: false
			};
	//infobox_text_options = 	
	//creating the infobox outside of the for loop and passing in options
	var infobox = new InfoBox (infobox_options);

	//defining marker and iterator outside of the loop
	var marker, i;
       	
        var tree = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.png',
              new google.maps.Size (32,32), new google.maps.Point (0,0));
        var tree_shadow = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.shadow.png',
              new google.maps.Size (59, 32), new google.maps.Point (0,0), new google.maps.Point (0,32));

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

	//trying to set content outside of event listener
	
	
	//the event handler is within the for loop
      	google.maps.event.addListener(marker, 'click', (function(marker, i) {
        	return function() {
        	infobox.setContent("Garden:  "+ gardens[i][0] + "<br>" + "Description:  " + gardens[i][2] + "<br>" + "Plant:  " + gardens[i][3] + "<br>" + "Planting Date:  " + gardens[i][4] + "<br>" + "Quantity:  " + gardens[i][5]);
          	infobox.open(map, marker);
	        }
     	 })(marker, i));
        }
//above closes the for loop


}
//above closes initialize

