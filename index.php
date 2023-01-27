<?php
require_once 'config.php';
require_once 'functions.php';
require_once('navbar.php');


$customers = readCustomers();
session_start();
$menu = "home";
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>KIYARASA</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
</head>

<body>

  <div class="container">
    <div class="container-logout">
      <form action="" method="POST" class="login-email">
        <?php echo "<h1>Selamat Datang, " . $_SESSION['username'] . "!" . "</h1>"; ?>
      </form>
    </div>
    <h1 class="text-center my-5">Daftar Customer</h1>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Image</th>
          <th>Address</th>
          <th>Order</th>
          <th>Order Date</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($customers as $customer) : ?>
          <tr>
            <td><?= $customer['id'] ?></td>
            <td><?= $customer['customer_name'] ?></td>
            <td><img src="photos/<?= $customer['photo'] ?>" width="50" height="50"></td>
            <td><?= $customer['address'] ?></td>
            <td><?= $customer['order_what'] ?></td>
            <td><?= $customer['order_date'] ?></td>
            <td>
              <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="edit.php?id=<?= $customer['id'] ?>" class="btn btn-warning">Edit</a>
              <a href="delete.php?Id=<?= $customer['Id'] ?>" name="Id" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="form.php" class="btn btn-primary my-3">Tambah Customer</a>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- JQUERY 3.X -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

  <!-- Datatable -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function() {
      // alert('Hallo');
      const modal = document.getElementById('exampleModal')
      modal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const id = button.getAttribute('data-bs-id');
        const aksi = button.getAttribute('data-bs-aksi');
        // console.log(id);
        $.post('edit.php', {
          id,
          aksi
        }, function(a) {
          // console.log(a);
        }).done(function(x) {
          $('.modal-body').html(x);
        }).fail(function() {
          alert("error");
        }).always(function() {
          // alert("finished");
        });
      });


      // proses update
      $("#edit").submit(function(event) {
        event.preventDefault();
        // const data_form = this.serialize();
        // console.log(data_form);
      });


      $('.table').DataTable();

    });
  </script>

</body>

</html>