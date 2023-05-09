<!--
Chris McKenna
CIS 166AE
Final Project
-->

<?php
  include 'includes/dbh.php';
  include_once 'includes/ScottBook.php';
  global $conn;
  $menu = new ScottBook($conn);
?>
<nav>
  <!-- Database driven menu. 'menu' db must include: link name, link url, link order, link status (live/not live) -->
  <!--  Only display active links -->
  <ul>
    <?php $menu->getMenu(); ?>
  </ul>
</nav>
