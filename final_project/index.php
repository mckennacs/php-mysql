<?php
  session_start();
  include_once 'includes/ScottBook.php';
  global $conn;
  $index = new ScottBook($conn);
  $theme = $index->getValidUserTheme();
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
    if(isset($_SESSION['valid_user'])) {
      $first_name = $index->getValidUserName() ?? '';

      echo "<p>Welcome back, $first_name!</p>";
      echo "<p>Theme: $theme</p>";
    }
    else {
      echo "<p>Welcome to ScottBook! If you have an account you can log in, or sign up for a new account.</p>";
    }
  ?>
</main>
<!-- Footer -->
</body>
<?php include 'includes/footer.php' ?>

</html>