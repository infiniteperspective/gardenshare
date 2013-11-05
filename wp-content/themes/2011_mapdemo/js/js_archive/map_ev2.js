/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/

var tree = new google.maps.MarkerImage('/wp-content/themes/2011_mapdemo/images/tree.png');
var tree_shadow = new google.maps.MarkerImage('/wp-content/themes/2011_mapdemo/images/tree_shadow.png');

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


var gardens = [['Garden A', 32.725500, -117.252700],['Garden B', 32.725550, -117.252750]]; //declaring an array of static garden locations

function setMarkers(map, gardens){
for (var i = 0; i < gardens.length; i++) {
        var garden_array = gardens[i];
        var myLatLng = new google.maps.LatLng(garden_array[1], garden_array[2]);
        var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
		title: garden_array[0],
        });

}

} 
