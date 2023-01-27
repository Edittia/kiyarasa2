<?php
require_once 'config.php';
require_once 'functions.php';
// Get customer data
$id = $_GET['id'];
// $customer = getCustomer($id);

// Handle form submission
if (isset($_POST['submit'])) {
    $customer_name = $_POST['customer_name'];
    $photo = $_FILES['photo']['name'];
    $address = $_POST['address'];
    $target = "photos/" . $photo;
    $order_id = $_POST['order_id'];
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    updateCustomer($id, $customer_name, $photo, $address, $order_id);
    header("Location: index.php");
}


$query = "SELECT customer.*, `order`.`order_what`, `order`.`order_date`, customer_order.order_id FROM customer  JOIN `customer_order` ON customer.id = `customer_order`.`customer_id`  JOIN `order` ON `order`.`ID` = customer_order.order_id WHERE customer_order.customer_id = $id";

$result = mysqli_query($conn, $query);
$customer = $result->fetch_assoc();
// var_dump($customer['order_id']);die;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Customer</title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center my-5">Edit Customer</h1>
        <form id="edit" action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="customer_name">Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $customer['customer_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $customer['address']; ?>" required>
            </div>
            <div class="form-group">
                <select class="form-select" name="order_id">
                    <?php
                    $sql = "SELECT * FROM `order`";
                    $value = $conn->query($sql);
                    while ($data = $value->fetch_assoc()) {
                    ?>
                        <option value="<?= $data['ID'] ?>" <?php
                                                            if ($data['ID'] == $customer['order_id']) echo 'selected' ?>><?= $data['order_what'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>