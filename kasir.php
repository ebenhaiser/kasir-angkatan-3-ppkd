<?php
session_start();
session_regenerate_id();

// $queryKasir = mysqli_query($koneksi, "SELECT * FROM kasir WHERE id_kasir = '$_SESSION[id_kasir]'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
  <?php require_once "inc/navbar.php" ?>

  <div class="container justify-content-center">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="card mt-3">
          <div class="card-header text-center">
            <h1>Manage Kasir</h1>
          </div>
          <div class="card-body">
            <div class="table table-responsive">
              <div class="mt-2 mb-2">
                <a href="tambah-transaction.php" class="btn btn-primary btn-sm">Kasir</a>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Struk Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>