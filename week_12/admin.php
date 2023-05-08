<!--
Chris McKenna
CIS 166AE
Module 13 Assignment
-->

<?php
	include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Admin Page</title>
</head>
<?php include 'includes/header.php'; ?>
<body>

<?php
  // MySQL select statement
  $sql = "SELECT * FROM users;";
  // Uses mysqli_query function to use the $conn mysqli_connect function as defined in dbh.inc.php
  $result = mysqli_query($conn, $sql);
  // Checks to see if any rows are present in table
	$resultCheck = mysqli_num_rows($result);

  echo "<table>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Username</th>";
  echo "<th>Password</th>";
  echo "<th>First Name</th>";
  echo "<th>Last Name</th>";
  echo "<th>Email</th>";
  echo "<th>Phone Number</th>";
  echo "<th>Edit User</th>";
  echo "</tr>";

  // If there are any rows in users table, outputs HTML table containing the value of each field for every row
	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['password'] . "</td>";
      echo "<td>" . $row['first_name'] . "</td>";
      echo "<td>" . $row['last_name'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['phone'] . "</td>";
      echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
      echo "</tr>";
      echo "</tr>";
		}
	}
  echo "</table>";
?>
</body>
</html>