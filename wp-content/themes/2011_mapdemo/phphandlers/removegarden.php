<?php
/*  Title: removegarden.php
 *  Purpose: You guessed it. The challenge here is that a user will have to remove all food exchanges before they can remove their garden.  Or you can allow a garbage function to clear out the old food exchanges. *  Things that are more than two weeks old.
*/

//Creating variables to insert for testing purposes
$userid = (2);

//Pulling data from the string built by post
//$userid = $_POST['userid'];

//Connection information
require_once('/var/www/wordpress/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');

//Connect to MySQL Server 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

//escaping the user input to help prevent SQL injection attacks
//must be done after connection is created because mysqli expects conn as an arguement
$userid = mysqli_real_escape_string($conn,$userid);

// check connection 
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();}

//Build the SQL query
$query = "DELETE FROM gardens WHERE userid = $userid";

//Execute query and store result
$result = $conn->query($query);

//Releasing the memory location that is storing the resultset and 
//closing the connection.
function release_connection ($result,$conn){
if ($result == TRUE){
$result->free;
$conn->close;}
else echo "Shit went south";
}

?>
