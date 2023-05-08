<!--
Chris McKenna
CIS 166AE
Module 13 Assignment
-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
// Starts session before HTTP headers sent
session_start();

include 'includes/header.php';

if (isset($_SESSION['valid_user'])) {
  echo "<p class='success'>You're logged in!</p>";
}
else {
  header("Location:error.php");
}
?>

