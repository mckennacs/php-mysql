<?php
  session_start();
  include_once 'includes/ScottBook.php';
  global $conn;
  $slideshow = new ScottBook($conn);
  $theme = $slideshow->getValidUserTheme();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
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
  <section>
<!--    <figure>-->
<!--      <img src="images/baio.jpg" alt="Scott Baio">-->
<!--      <figcaption>-->
<!--        <h3>Scott Baio</h3>-->
<!--        <p>Scott Vincent James Baio ( born September 22, 1960 or 1961 (sources differ)) is an American actor and television director.</p>-->
<!--      </figcaption>-->
<!--    </figure>-->
    <?php $slideshow->displaySlideshow(); ?>
  </section>
</main>
<!-- Footer -->
</body>
<?php include 'includes/footer.php' ?>

</html>
