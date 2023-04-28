<!--
Chris McKenna
CIS 166AE
Module 11 Assignment
-->

<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <title>LoginBox</title>
</head>
<header>
  <nav>
    <ul>
      <li>
        <a href="index.php">Log In</a>
      </li>
      <li>
        <a href="admin.php">Admin</a>
      </li>
      <li>
        <a href="signup-form.php">Sign Up</a>
      </li>
    </ul>
  </nav>
  <h2>Log In</h2>
</header>
<body>
<main>
<?php

	// Include LoginBox
  include ('includes/LoginBox.php');

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