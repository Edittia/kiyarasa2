<?php 
 
session_start();
$menu = "logout";
session_destroy();
 
header("Location: login.php");
 
?>