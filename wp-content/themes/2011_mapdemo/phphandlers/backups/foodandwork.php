<?php
//references file that has connection string
include_once("dbconnect.php");

//Connect to MySQL Server Connection String: mysql --host=localhost --user=wordpressuser --password=trooper wordpress
//$conn = mysql_connect($dbhost, $dbuser, $dbpass);
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

/* check connection */
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();}
    else echo "Connection success!";

//Build the SQL query
$query = "SELECT plantforexchange, quantity, available_date, desired_exchange, user_nicename, user_email FROM food_exchanges, wp_users WHERE userid=ID LIMIT 10";
//Execute query and store result
$result = $conn->query($query);

//Check if query returns a resultset */
if ($result == TRUE) {
    printf("Select returned %d rows.\n", $result->num_rows);}
    else echo "Query failed!";

//Accessing resultset array
while ($row = $result->fetch_array(MYSQLI_NUM)){
printf ("Plant for Exchange: %s, Quantity:  %s, Available Date: %s, Desired Plant for Exchange: %s , POC: %s, Email: %s \n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);}

//Releasing the memory location that is storing the resultset and 
//closing the connection.
$result->free();
$conn->close();

?>
