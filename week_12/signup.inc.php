<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php

	include('includes/dbh.inc.php');
	include_once('includes/LoginBox.php');

	$new_account = new LoginBox();

	$new_account_info = [
		// Uses addslashes() to add escape characters to single quote/double quote/backslash characters to be processed by PHP
		// The null coalescing operator (??) is used to check if the input fields exist, otherwise returns a blank string
		// https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
		addslashes($_POST['new-user'] ?? ''),
		addslashes($_POST['new-password'] ?? ''),
		addslashes($_POST['first-name'] ?? ''),
		addslashes($_POST['last-name'] ?? ''),
		addslashes($_POST['email'] ?? ''),
		addslashes($_POST['phone'] ?? '')
	];

	// Creates new user account using signup form fields as stored in $new_account_info array
	$new_account->createAccount($new_account_info, $conn);






