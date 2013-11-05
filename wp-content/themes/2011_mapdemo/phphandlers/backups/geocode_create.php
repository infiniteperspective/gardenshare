<?php
//This file pulls geocodes from the mysql db and creates an xml document that can be ingested by javascript

//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');

//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();}

//Build the SQL query
$query = "SELECT street_address, city, state, zipcode FROM gardens";

//Execute query and store result
$result = $conn->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

while ($row = $result->fetch_array(MYSQLI_NUM)){
              $street_address = $row[0];               
              $city = $row[1];               
              $state = $row[2];               
              $zipcode = $row[3];}               
echo $street_address, $city, $state, $zipcode;

?>


