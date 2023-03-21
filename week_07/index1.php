<!--
Chris McKenna
CIS 166AE
Module 8 Assignment
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Module 8 Assignment</title>
</head>
<body>

<?php

	// Include LoginBox
	include ('includes/LoginBox.php');
  // Sets submit label to 'Check me' during object instantiation
  $loginBox = new LoginBox('Check me');
  echo $loginBox->DisplayLogin();

  // Uses CheckLogin function to redirect based on login validation
  if(isset($_POST["submit"])){
    echo $loginBox ->CheckLogin($_POST["username"], $_POST["password"]);
  }


?>
</body>
</html>