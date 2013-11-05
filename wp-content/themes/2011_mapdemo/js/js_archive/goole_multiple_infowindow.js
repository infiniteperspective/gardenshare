<script type="text/javascript">
function initialize() {
var myOptions = {
zoom: 10,
center: new google.maps.LatLng(-33.9, 151.2),
mapTypeControl: true,
mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
navigationControl: true,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
var map = new google.maps.Map(document.getElementById("map_canvas"),
myOptions);
google.maps.event.addListener(map, 'click', function() {
infowindow.close();
});
setMarkers(map, beaches);
}
var icons = new Array();
icons["red"] = new google.maps.MarkerImage("mapIcons/mm_20_3d_red.png",
// This marker is 20 pixels wide by 32 pixels tall.
new google.maps.Size(12, 20),
// The origin for this image is 0,0.
new google.maps.Point(0,0),
// The anchor for this image is the base of the flagpole at 0,32.
new google.maps.Point(6, 20));
function getMarkerImage(iconColor) {
if ((typeof(iconColor)=="undefined") || (iconColor==null)) {
iconColor = "red";
}
if (!icons[iconColor]) {
// icons[iconColor].image = "http://labs.google.com/ridefinder/images/mm_20_"+ iconColor +".png",
icons[iconColor] = new google.maps.MarkerImage("mapIcons/mm_20_3d_"+ iconColor +".png",
// This marker is 20 pixels wide by 32 pixels tall.
new google.maps.Size(12, 20),
// The origin for this image is 0,0.
new google.maps.Point(0,0),
// The anchor for this image is the base of the flagpole at 0,32.
new google.maps.Point(6, 20));
}
return icons[iconColor];
// new google.maps.MarkerImage("mapIcons/mm_20_3d_"+ beach[4] +".png"),
}
// Marker sizes are expressed as a Size of X,Y
// where the origin of the image (0,0) is located
// in the top left of the image.
// Origins, anchor positions and coordinates of the marker
// increase in the X direction to the right and in
// the Y direction down.
var iconImage = new google.maps.MarkerImage('http://labs.google.com/ridefinder/images/mm_20_red.png',
// This marker is 20 pixels wide by 32 pixels tall.
new google.maps.Size(12, 20),
// The origin for this image is 0,0.
new google.maps.Point(0,0),
// The anchor for this image is the base of the flagpole at 0,32.
new google.maps.Point(6, 20));
var iconShadow = new google.maps.MarkerImage('http://labs.google.com/ridefinder/images/mm_20_shadow.png',
// The shadow image is larger in the horizontal dimension
// while the position and offset are the same as for the main image.
new google.maps.Size(22, 20),
new google.maps.Point(0,0),
new google.maps.Point(6, 20));
// Shapes define the clickable region of the icon.
// The type defines an HTML &lt;area&gt; element 'poly' which
// traces out a polygon as a series of X,Y points. The final
// coordinate closes the poly by connecting to the first
// coordinate.
var iconShape = {
coord: [4,0,0,4,0,7,3,11,4,19,7,19,8,11,11,7,11,4,7,0],
type: 'poly'
};
var infowindow = new google.maps.InfoWindow(
{
size: new google.maps.Size(150,50)
});
function createMarker(map, latlng, label, html, color) {
var contentString = '<b>'+label+'</b><br>'+html;
var marker = new google.maps.Marker({
position: latlng,
map: map,
shadow: iconShadow,
icon: getMarkerImage(color),
shape: iconShape,
title: label,
zIndex: Math.round(latlng.lat()*-100000)<<5
});
google.maps.event.addListener(marker, 'click', function() {
infowindow.setContent(contentString);
infowindow.open(map,marker);
});
}
/**
* Data for the markers consisting of a name, a LatLng and a zIndex for
* the order in which these markers should display on top of each
* other.
*/
var beaches = [
['Bondi Beach', -33.890542, 151.274856, "red"],
['Coogee Beach', -33.923036, 151.259052, "blue"],
['Cronulla Beach', -34.028249, 151.157507, "green"],
['Manly Beach', -33.80010128657071, 151.28747820854187, "yellow"],
['Maroubra Beach', -33.950198, 151.259302, "orange"]
];
function setMarkers(map, locations) {
// Add markers to the map
for (var i = 0; i < locations.length; i++) {
var beach = locations[i];
var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
var marker = createMarker(map,myLatLng,beach[0],beach[0],beach[3]);
}
} 
