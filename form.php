<?php
require_once 'config.php';
require_once 'functions.php';

// Handle form submission
if (isset($_POST['submit'])) {
  $customer_name = $_POST['customer_name'];
  $photo = $_FILES['photo']['name'];
  $address = $_POST['address'];
  $target = "photos/" . $photo;
  $order_id = $_POST['order_id'];
  move_uploaded_file($_FILES['photo']['tmp_name'], $target);

  addCustomer($customer_name, $photo, $address, $order_id);
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tambah Customer</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="text-center my-5">Tambah Customer</h1>
    <form action="form.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="customer_name">Nama</label>
        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
      </div>
      <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="form-group">
        <select class="form-select" name="order_id">
          <?php
          $sql = "SELECT * FROM `order`";
          $value = $conn->query($sql);
          while ($data = $value->fetch_assoc()) {
          ?>
            <option value="<?= $data['ID'] ?>"><?= $data['order_what'] ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>

    </form>
  </div>
</body>

</html>