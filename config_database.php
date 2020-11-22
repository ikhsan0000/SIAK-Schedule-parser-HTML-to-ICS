<?php
/* Attempt to connect to database */
$link = pg_connect("host=localhost dbname=scheduie user=postgres password=120399");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . "Error");
}
?>

