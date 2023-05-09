<?php
  include_once 'includes/ScottBook.php';
  global $conn;
  $signup = new ScottBook($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="css/default.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
  <!--  TODO: Dynamically update title with php  -->
  <title>Title</title>
</head>

<body>
<!-- Header -->
<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/menu.php' ?>

<!-- Main -->
<main>
  <?php
    include "includes/signup-form.php";
    $signup->createAccount();
  ?>
</main>
<!-- Footer -->
</body>
<?php include 'includes/footer.php' ?>

</html>
