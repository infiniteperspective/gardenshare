<?php
/*  Title: addressgeocoder.php
 *  Purpose: Demonstrate geocoding an address and writing it to the geocode database.
 *  
 *
*/

//Accessing the gardens database
//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();}

//Build the SQL query
$query = "SELECT street_address, city, state FROM gardens;";

//Execute query and store result
$result = $conn->query($query);

if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$row = $result->fetch_array(MYSQLI_NUM);
printf ("%s %s %s\n", $row[0], $row[1],$row[2]);

//Freeing the result. Necessary for query.
$result->free();
//Closing the connection
$conn->close();

?>
