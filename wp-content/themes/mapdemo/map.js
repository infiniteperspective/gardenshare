function initialize() {
	map = new google.maps.Map(document.getElementById('map'), { 
		zoom: 12, 
		center: new google.maps.LatLng(32.725523, -117.252789), 
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	});
}
