<!--
Chris McKenna
CIS 166AE
Final Project
-->

<?php
session_start();
include_once 'includes/ScottBook.php';
global $conn;
$edit = new ScottBook($conn);
$theme = $edit->getValidUserTheme();
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
    $edit->editUser();
  ?>
</main>
<!-- Footer -->
</body>
<?php include 'includes/footer.php' ?>

</html>