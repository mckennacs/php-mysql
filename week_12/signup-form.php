<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php
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
<?php include 'includes/header.php'; ?>
<body>
<main>
<?php

  // Creates new LoginBox() object to output new account form
  $account_form = new LoginBox($conn);

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