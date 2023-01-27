<?php
require_once 'config.php';

function readCustomers() {
  global $conn;
  $query = "SELECT customer.*, `order`.`order_what`, `order`.`order_date`, customer_order.Id FROM customer  JOIN `customer_order` ON customer.id = `customer_order`.`customer_id`  JOIN `order` ON `order`.`ID` = customer_order.order_id";
  $result = mysqli_query($conn, $query);
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addCustomer($customer_name, $photo, $address, $order_id) {
    global $conn;
    $sql = "INSERT INTO customer (customer_name, photo, `address`) 
    VALUES ('$customer_name', '$photo', '$address')";
     mysqli_query($conn, $sql);
     $customer_id = $conn->insert_id;
     $sql2 = "INSERT INTO customer_order(order_id, customer_id) 
     VALUES ('$order_id', '$customer_id')";
     mysqli_query($conn, $sql2);
}


// function getCustomer($id = null)
// {
//   global $conn;
//   $query = "SELECT * FROM customer";
//   if ($id != null) {
//     $query = "SELECT * FROM customer WHERE id = '$id'";
//   }
//   $result = mysqli_query($conn, $query);
//   $customers = [];
//   while ($row = mysqli_fetch_assoc($result)) {
//     $customers[] = $row;
//   }
//   return $customers;
// }


// function createCustomer($customer_name, $photo,$address) {
//   global $conn;
//   $query = "INSERT INTO customer (customer_name, photo, address
// ) VALUES ('$customer_name', '$photo','$address
// ')";
//    mysqli_query($conn, $query);
// }

function updateCustomer($id, $customer_name, $photo,$address,$order_id) {
  global $conn;
  $sql="SELECT * FROM customer WHERE id = $id";
  $value= $conn->query($sql);
  $data= $value->fetch_assoc();
  unlink('photos/'.$data['photo']);
  $query = "UPDATE customer JOIN customer_order ON customer.id = customer_order.customer_id SET customer.customer_name = '$customer_name', customer.photo = '$photo', customer.address= '$address', customer_order.order_id =  $order_id
  WHERE customer_order.customer_id = '$id'";
  mysqli_query($conn, $query);
}

function deleteCustomer($id) {
  global $conn;
  // $sql="SELECT * FROM customer WHERE id = $id";
  // $value= $conn->query($sql);
  // $data= $value->fetch_assoc();
  // unlink('photos/'.$data['photo']);
  $query = "DELETE FROM customer_order WHERE Id = $id";
  return mysqli_query($conn, $query);
}
