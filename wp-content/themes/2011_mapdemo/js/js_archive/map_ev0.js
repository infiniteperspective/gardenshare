/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/

function initialize() {
	map = new google.maps.Map(document.getElementById('map'), { 
		zoom: 13, 
		center: new google.maps.LatLng(32.725523, -117.252789), 
		mapTypeId: google.maps.MapTypeId.TERRAIN 
	});
}
