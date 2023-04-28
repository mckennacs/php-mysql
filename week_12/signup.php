<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php


	include_once('includes/LoginBox.php');

  $newAccount = new LoginBox($conn);

  // Uses mysqli_real_escape_string, trim, and htmlspecialchars() to trim leading/trailing spaces, convert html to special characters and add escape characters to add to database
  // The null coalescing operator (??) is used to check if the input fields exist, otherwise returns a blank string
  // https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
  $u_name = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['new-user'])) ?? '');
  $pwd = mysqli_real_escape_string($conn,trim(htmlspecialchars($_POST['new-password'])) ?? '');
  $first = mysqli_real_escape_string($conn,trim(htmlspecialchars($_POST['first-name'])) ?? '');
  $last = mysqli_real_escape_string($conn,trim(htmlspecialchars($_POST['last-name'])) ?? '');
  $email = mysqli_real_escape_string($conn,trim(htmlspecialchars($_POST['email'])) ?? '');
  $phone = mysqli_real_escape_string($conn,trim(htmlspecialchars($_POST['phone'])) ?? '');

	$new_account_info = [
    $u_name,
    $pwd,
    $first,
    $last,
    $email,
    $phone
  ];

  if(isset($_POST['submit'])){
    $newAccount->createAccount($new_account_info);
  }








