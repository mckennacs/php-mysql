<!--
Chris McKenna
CIS 166AE
Module 13 Assignment
-->

<?php
  session_start();
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <title>LoginBox</title>
</head>
<!-- Moved header to its own file -->
<?php
include 'includes/header.php';

if(isset($_SESSION['valid_user'])) {
  $bg_color = "lightgray";
  $class = "logged-in";
}
else {
  $bg_color = "#00FF94";
  $class="";
}
?>
<body style="background-color:<?php echo $bg_color; ?>" class="<?php echo $class; ?>">
<h2>Log in</h2>
<main>
<?php

	// Include LoginBox
  include 'includes/LoginBox.php';

  // Creates new LoginBox object
  $login_box = new LoginBox($conn);
  $login_box ->setLabel('Log In');

  // Defines Exception message in case LoginBox can not be displayed
  try
  {
    $login_box->displayLogin();
    $login_exception = new Exception("LoginBox could not be displayed.");
  }
  catch(Exception $login_exception)
  {
    $login_exception->getMessage();
  }

  // Checks login credentials once user hits submit
  if(isset($_POST["submit"])){
		// Assigns values of $_POST to new variables $username and $password, using addslashes() to add escape characters if required.
    $username = $_POST["username"];
    $password = $_POST["password"];
    $login_box->authenticate($username, $password);
  }
?>
</main>
</body>
</html>