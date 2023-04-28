<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href=../css/style.css" rel="stylesheet" type="text/css" />
	<title>Delete</title>
</head>
<body>
<?php
	// Includes MySQL database login info
	include_once 'includes/dbh.inc.php';
	// If connection not successful, outputs error message
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Checks to make sure $_GET['id'] is set
  if(isset($_GET['id'])) {
		// Checks if id is an integer and a valid id number (greater than 0)
    $id = intval($_GET['id']);
    if (is_int($id) && $id > 0) {
			// SQL query to delete user based on id
      $sql = "DELETE FROM `users` WHERE `id`=" . $id;
      if (mysqli_query($conn, $sql)) {
				// If delete is successful, redirects user to admin page after displaying success message
        header("Refresh:5, url=admin.php");
				echo "<div class='success'>";
				echo "<p>Record deleted.</p>";
				echo "<p>You will be redirected to the admin page in 5 seconds, or click <a href='admin.php'>here</a></p>";
				echo "</div>";
      }
      else {
				// Prints error if $sql query doesn't work
        echo "ERROR: Could not execute $sql" . mysqli_error($conn);
      }
    }
  }
?>

</body>
</html>

