/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/


var gardens = [['Garden A', 32.725500, -117.252700],['Garden B', 32.725550, -117.252750]]; //declaring an array of static garden locations


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

}

} 
