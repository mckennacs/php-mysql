<!--
Chris McKenna
CIS 166AE
Module 11 Assignment
-->

<?php
  // Include mysql database login info
	include_once 'includes/dbh.inc.php';
  // Include LoginBox
  include_once ('includes/LoginBox.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Sign Up</title>
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
  <h2>Create New Account</h2>
</header>
<body>
<main>
<?php

  // Creates new LoginBox() object to output new account form
	$account_form = new LoginBox();

	try
	{
    // Outputs new account form
		echo $account_form->getAccountForm();
		$account_exception = new Exception("LoginBox could not be displayed.");
	}
	catch(Exception $account_exception)
	{
		echo $account_exception->getMessage();
	}

?>
</main>
</body>
</html>