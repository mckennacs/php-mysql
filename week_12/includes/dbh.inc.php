<!--
Chris McKenna
CIS 166AE
Module 13 Assignment
-->
<?php

	$dbServername = "localhost:3307";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "module_13";
  $salt = 'fdsk934nflcvxcljf9023r0k43R%42359SF094i';


	// Connects to server with the server name, username/password, and database name defined above.
	$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

	// var_dump($conn);
