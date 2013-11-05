/*  Title: map.js
 *  Purpose: Connect to google maps service, call map centered on Ocean Beach,
 *  and let the fun begin. Built off of marty spellerberg's awesome Google Maps
 *  tutorial.
 *
 *
 *
*/

//declaring an array of static garden locations
var gardens = [{Title: "Garden A", latLng: new google.maps.LatLng(32.729000, -117.250000), Description: "This is content for Garden A", Plant: "Avocados", Planting_Date: "12/12/2012", Quantity: "5"},{Title: "Garden B", latLng: new google.maps.LatLng(32.725000, -117.253000), Description: "This is content for Garden B", Plant: "Squash", Planting_Date: "12/13/2012", Quantity: "10"}]; 

function initialize() {

	var map_center = new google.maps.LatLng(32.725523,-117.252789);
	var marker
	var mapOptions = {
		zoom: 13,
		center: map_center,
		mapTypeId: google.maps.MapTypeId.SATELLITE
};

	var map = new google.maps.Map(document.getElementById('map'), mapOptions);

       	
  function initMarkers(map, gardens) {
          var newMarkers = [],
              marker;
          var tree = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.png',
              new google.maps.Size (32,32), new google.maps.Point (0,0));
          var tree_shadow = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/tree.shadow.png',
              new google.maps.Size (59, 32), new google.maps.Point (0,0), new google.maps.Point (0,32));

        for(var i=0; i<gardens.length; i++) {
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: gardens[i].latLng,
                visible: true,
		icon: tree,
		shadow: tree_shadow,
		title: gardens[i].Title
            });
	}
}
//above closes function initMarkers

    //here the call to initMarkers() is made with the necessary data for each marker.  All markers are then returned as an array into the markers variable
    markers = initMarkers(map,gardens);
}
//above function initialize

