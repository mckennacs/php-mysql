<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php
	include_once 'includes/dbh.inc.php';
	include_once 'includes/LoginBox.php';

  if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

	// Creates new LoginBox() object to use updateAccount function
	$edit_account = new LoginBox();

  if(isset($_POST['submit'])) {

      // $edit_account->updateAccount($update_account_info, $_POST['id']);
      // $update_errors =[];
      // $valid_phone_pattern = '^[1-9]{1}[0-9]{2}[-|.]{1}[1-9]{1}[0-9]{2}[-|.]{1}[0-9]{4}';

      // If no fields are filled in, adds error message to $update_errors
      // if(!$_POST['username'] || !$_POST['password'] || !$_POST['first-name'] || !$_POST['last-name'] || !$_POST['email'] || !$_POST['phone']) {
      //   $update_errors[] = '<p>Please enter all required information</p>';
      // }
      // Checks to see if email is valid
      // if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      //   $update_errors[] = '<p>Invalid email</p>';
      // }
      // Uses preg_match to check if phone number is valid. If not, adds error message to $errors
      // if (!preg_match("/$valid_phone_pattern/", $_POST['phone'])) {
      //   $update_errors[] = '<p>Invalid phone number</p>';
      // }

    $id = $_POST['id'];
    $pattern = '/-/';
    // Using ArrayIterator() to limit foreach() loop below to
    // https://www.php.net/manual/en/class.limititerator.php
    $fields = new ArrayIterator($_POST);
    $sql_arr = [];
    // If there are elements in the post array, adds field to mysql query
    $sql = "UPDATE `users` SET" . ' ';
    foreach (new LimitIterator($fields, 0, 6) as $key => $value){
      if (!empty($value)){
        $key = preg_replace($pattern, "_", $key);
				// TODO: add htmlspecialchars and real_escape_string to other auth
        $value = mysqli_real_escape_string($conn, $value);
        $sql_arr[] = "`$key`='$value'";
        $sql .= implode(", ", $sql_arr);
      }
    }
    $sql .= " WHERE `id` = '$id';";

    if (!empty($sql_arr)){
      if(mysqli_query($conn, $sql)){
        header("Refresh:3, url=admin.php");
        echo "Record updated successfully.";
        // echo $sql;
      } else {
        echo "ERROR: Could not execute $sql." . mysqli_error($conn);
      }
    }
    else {
      echo "No records changed.";
    }
  }


