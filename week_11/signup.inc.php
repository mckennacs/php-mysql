<?php

	include('includes/dbh.inc.php');
	include_once('includes/LoginBox.php');

	$new_account = new LoginBox();

	$new_account_info = [
		// Uses addslashes() to add escape characters to single quote/double quote/backslash characters to be processed by PHP
		addslashes($_POST['new-user']),
		addslashes($_POST['new-password']),
		addslashes($_POST['first-name']),
		addslashes($_POST['last-name']),
		addslashes($_POST['email']),
		addslashes($_POST['phone'])
	];

	// Creates new user account using signup form fields as stored in $new_account_info array
	$new_account->createAccount($new_account_info, $conn);






