<?php
//This file pulls geocodes from the mysql db and creates an xml document that can be ingested by javascript

//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("garden_markers");
$parnode = $dom->appendChild($node); 

//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();}

//Build the SQL query
$query = "SELECT * FROM garden_geocode WHERE 1";

//Execute query and store result
$result = $conn->query($query);

if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("garden_markers");
  $newnode = $parnode->appendChild($node);

  $newnode->setAttribute("gardenid", $row['gardenid']);
  $newnode->setAttribute("latitude", $row['latitude']);
  $newnode->setAttribute("longitude", $row['longitude']);
}

echo $dom->saveXML();

?>


