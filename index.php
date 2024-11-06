<?php
require_once 'config/connection.php';
include 'config/login-validation.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include 'inc/style.php' ?>
</head>

<body>
  <?php include 'inc/navbar.php' ?>

  <?php
  if (isset($_GET['pg'])) {
    if (file_exists('content/' . $_GET['pg'] . '.php')) {
        include 'content/' . $_GET['pg'] . '.php';
    }
  } else {
      include 'content/dashboard.php';
  }
  ?>
  <?php include 'inc/footer.php' ?>
  <?php include 'inc/script.php' ?>
</body>

</html>