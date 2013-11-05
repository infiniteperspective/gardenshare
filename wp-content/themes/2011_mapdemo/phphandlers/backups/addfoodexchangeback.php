<?php
//Creating variables to test db insert
//$userid = (2);
//$gardenid = (1);
//$plantforexchange = "grapes";
//$exchangequantity = (12);
//$datepicker = "2013-05-13";
//$desiredexchange = "tomatoes";

//Pulling data from the string built by post
$userid = $_POST['userid'];
$gardenid = $_POST['gardenid'];
$plantforexchange = $_POST['plantforexchange'];
$exchangequantity = $_POST['exchangequantity'];
$availabilitydate = $_POST['availabilitydate'];
$desiredexchange = $_POST['desiredexchange'];

//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');

//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

//escaping the user input to help prevent SQL injection attacks
//must be done after connection is created because mysqli expects conn as an arguement
$userid = mysqli_real_escape_string($conn,$userid);
$gardenid = mysqli_real_escape_string($conn,$gardenid);
$plantforexchange = mysqli_real_escape_string($conn,$plantforexchange);
$exchangequantity = mysqli_real_escape_string($conn,$exchangequantity);
$availabilitydate = mysqli_real_escape_string($conn,$availabilitydate);
$desiredexchange = mysqli_real_escape_string($conn,$desiredexchange);

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();}

//Build the SQL query
$query = "INSERT INTO food_exchanges (userid, gardenid, plantforexchange, quantity, available_date, desired_exchange) values ($userid,$gardenid,'$plantforexchange',$exchangequantity, STR_TO_DATE('$availabilitydate','%m/%d/%Y'), '$desiredexchange')";

//Execute query and store result
$result = $conn->query($query);

//Releasing the memory location that is storing the resultset and 
//closing the connection.
function release_connection ($result,$conn){
if ($result == TRUE){
$result->free;
$conn->close;
}
else echo "Shit went south";
}

?>

