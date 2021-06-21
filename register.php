<?php

require 'config_database.php';

$username = $_POST['loginUsername'];
$password = $_POST['loginPassword'];
echo $password . "<br>";
$password = password_hash($password, PASSWORD_DEFAULT);
echo $password . "<br>";
$query_jadwal = "INSERT INTO login VALUES ('$username', '$password')";
mysqli_query($link, $query_jadwal);


?>