<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php
	include_once 'includes/dbh.inc.php';
	include_once 'includes/LoginBox.php';

	// Creates new LoginBox() object to use updateAccount function
	$edit_account = new LoginBox();

	$update_account_info = [
		// Uses addslashes() to add escape characters to single quote/double quote/backslash characters to be processed by PHP
		// The null coalescing operator (??) is used to check if the input fields exist, otherwise returns a blank string
		// https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
		addslashes($_POST['username'] ?? ''),
		addslashes($_POST['password'] ?? ''),
		addslashes($_POST['first-name'] ?? ''),
		addslashes($_POST['last-name'] ?? ''),
		addslashes($_POST['email'] ?? ''),
		addslashes($_POST['phone'] ?? '')
	];

	try
	{
		$edit_account->updateAccount($update_account_info, $_POST['id'], $conn);
		$update_exception = new Exception("Account could not be updated.");
		echo '<link href="week_11/css/style.css" rel="stylesheet" type="text/css" />';
		echo "<div class='success'>";
		echo "<p>Account info updated.</p>";
		echo "<p>You will be redirected to the admin page in 5 seconds, or click <a href='week_11/admin.php'>here</a></p>";
		echo "</div>";
	}
	catch (Exception $update_exception)
	{
		echo $update_exception->getMessage();
	}