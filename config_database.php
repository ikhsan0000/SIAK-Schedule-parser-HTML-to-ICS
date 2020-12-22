<?php
/* Attempt to connect to database */
$link = mysqli_connect("localhost", "root", null, "scheduie");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . "Error");
}
?>

