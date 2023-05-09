<?php
session_start();
include_once 'includes/ScottBook.php';
global $conn;
$admin = new ScottBook($conn);
$theme = $admin->getValidUserTheme();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!--  <link href="css/vaporwave.css" rel="stylesheet" type="text/css" />-->
  <!-- css file determined by user theme -->
  <link href="css/<?php echo $theme ?>.css" rel="stylesheet" type="text/css" />
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
    $admin->displayAdminPanel();
  ?>
</main>
<!-- Footer -->
<?php include 'includes/footer.php' ?>
</body>

</html>
