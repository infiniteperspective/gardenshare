/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/


var gardens = [['Garden A', 32.725500, -117.252700,'This is content for Garden A','Avocados','12/12/2012','5'],['Garden B', 32.725550, -117.252750,'This is content for Garden B','Squash','12/13/2012','10']]; //declaring an array of static garden locations

function initialize() {

	var map_center = new google.maps.LatLng(32.725523,-117.252789);
	var mapOptions = {
		zoom: 13,
		center: map_center,
		mapTypeId: google.maps.MapTypeId.TERRAIN
}

	var map = new google.maps.Map(document.getElementById('map'), mapOptions);

	setMarkers(map, gardens);

}


function setMarkers(map, gardens){
	for (var i = 0; i < gardens.length; i++) {
        	var garden_array = gardens[i];
        	var myLatLng = new google.maps.LatLng(garden_array[1], garden_array[2]);
        	
		var tree = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.png', 
		new google.maps.Size (32,32), new google.maps.Point (0,0));
		var tree_shadow = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.shadow.png',
		new google.maps.Size (59, 32), new google.maps.Point (0,0), new google.maps.Point (0,32));
		var marker = new google.maps.Marker({
                	position: myLatLng,
                	map: map,
			icon: tree,
			shadow: tree_shadow,
			title: garden_array[0]
       		 });


 		var boxText = document.createElement("div");
		boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background: #669999; padding: 5px;";
		boxText.innerHTML = "<h1>Garden Window</h1>"+"<h2><b>Garden:  </b>"+garden_array[0]+"</h2>"+"<h2><b>Fruit or Veggie:  </b>"+garden_array[4]+"</h2>"+"<h2><b>Planting Date:  </b>"+garden_array[5]+"</h2>"+"<h2><b>Quantity:  </b>"+garden_array[6];

		var infobox_options = {
			content: boxText
			,disableAutoPan: false
			,maxWidth: 0
			,pixelOffset: new google.maps.Size(-140, 0)
			,zIndex: null
			,boxStyle: {
				background: "#669999"
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
 		var infobox = new InfoBox(infobox_options);
		google.maps.event.addListener(marker, 'click', function(e) {infobox.open(map,marker);});  
}

} 
