/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/

function initialize() {

	var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
	var mapOptions = {
		zoom: 4,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
}

	var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: 'Hello World!'
});
} 
