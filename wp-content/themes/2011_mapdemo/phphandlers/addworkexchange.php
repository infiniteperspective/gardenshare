<?php

//Creating variables to insert for testing purposes
//$userid = (2);
//$firstname = "John Jones";
//$email = "john@yahoo.com";
//$experience = (4);
//$availablehours = (20);
//$availabledate = ("2013-04-13");
//$expertise = "I can hoe the ground like a mutha fucka";

//Pulling data from the string built by post
$userid = $_POST['userid'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$experience = $_POST['experience'];
$availablehours = $_POST['availablehours'];
$availabledate = $_POST['availabledate'];
$expertise = $_POST['expertise'];

//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');

//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();}

//escaping the user input to help prevent SQL injection attacks
//must be done after connection is created because mysqli expects conn as an arguement
$userid = mysqli_real_escape_string($conn,$userid);
$firstname = mysqli_real_escape_string($conn,$firstname);
$email = mysqli_real_escape_string($conn,$email);
$experience = mysqli_real_escape_string($conn,$experience);
$availablehours = mysqli_real_escape_string($conn,$availablehours);
$availabledate = mysqli_real_escape_string($conn,$availabledate);
$expertise = mysqli_real_escape_string($conn,$expertise);

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();}

//Build the SQL query
$query = "INSERT INTO work_exchanges (userid, first_name, email, experience, availability, available_date, expertise) VALUES ($userid,'$firstname','$email',$experience,$availablehours, STR_TO_DATE('$availabledate','%m/%d/%Y'), '$expertise')";

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

