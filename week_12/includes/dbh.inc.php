<?php

	$dbServername = "localhost:3307";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "module_13";


	// Connects to server with the server name, username/password, and database name defined above.
	$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

	// var_dump($conn);
