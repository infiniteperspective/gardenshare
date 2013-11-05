<?php
// header("Content-type: application/json");
//Creating variables to insert for testing purposes
//$userid =(2);
//$gardenname = "Wisteria";
//$address = "2345 Hanes Lane";
//$city = "San Diego";
//$state = "CA";
//$zipcode = "92107";
//$squarefootage = 50;
//$gardendescription = "This is where I grow tomatoes";
//$latitude = (32.725000);
//$longitude = (-117.257000);
 
//Pulling data from the string built by post
$userid = $_POST['userid'];
$gardenname = $_POST['gardenname'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$squarefootage = $_POST['squarefootage'];
$gardendescription = $_POST['gardendescription'];
$latitude =  $_POST['latitude'];
$longitude = $_POST['longitude'];

//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');

//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );
// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();}

//escaping the user input to help prevent SQL injection attacks
//must be done after connection is created because mysqli expects conn as an arguement
$userid = mysqli_real_escape_string($conn,$userid);
$gardenname = mysqli_real_escape_string($conn,$gardenname);
$address = mysqli_real_escape_string($conn,$address);
$city = mysqli_real_escape_string($conn,$city);
$state = mysqli_real_escape_string($conn,$state);
$zipcode = mysqli_real_escape_string($conn,$zipcode);
$squarefootage = mysqli_real_escape_string($conn,$squarefootage);
$gardendescription = mysqli_real_escape_string($conn,$gardendescription);
$latitude = mysqli_real_escape_string($conn,$latitude);
$longitude = mysqli_real_escape_string($conn,$longitude);

//Build the SQL query
$query = "INSERT INTO gardens (userid, garden_name, street_address, city, state, zipcode, square_footage, description, latitude, longitude) values ($userid,'$gardenname','$address', '$city', '$state', '$zipcode', $squarefootage, '$gardendescription', $latitude, $longitude)";

//Execute query and store result
$result = $conn->query($query);

if (!$result) {
//    printf("Errornumber: %d\n", $conn->errno);
//    printf("Errormessage: %s\n", $conn->error);
//    $error = array ($conn->errno,$conn->error);
    $error = $conn->errno;
    echo json_encode($error,JSON_FORCE_OBJECT);
    exit();}

//closing the connection.
$conn->close();

?>
