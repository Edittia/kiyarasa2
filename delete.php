<?php
require_once 'config.php';
require_once 'functions.php';

$id = $_GET['Id'];

if (deleteCustomer($id)) {
  header("Location: index.php");
} else {
  echo "Error: " . mysqli_error($conn);
}