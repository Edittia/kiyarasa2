<?php

$server ="localhost";
$username ="root";
$password ="";
$database ="kiyarasa2";

//Create Connection 
$conn = mysqli_connect("$server", "$username", "$password", "$database");

// Check Connection
if(!$conn) {
    die("Connection Failed: " .mysqli_connect_error());
}

?>