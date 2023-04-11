<!--
Chris McKenna
CIS 166AE
Module 11 Assignment
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
<body>

<?php
	$sql = "SELECT * FROM users;";
  $result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

  echo "<table>";
  echo "<tr>";
  echo "<th>Username</th>";
  echo "<th>Password</th>";
  echo "<th>First Name</th>";
  echo "<th>Last Name</th>";
  echo "<th>Email</th>";
  echo "<th>Phone Number</th>";
  echo "</tr>";

	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['password'] . "</td>";
      echo "<td>" . $row['first_name'] . "</td>";
      echo "<td>" . $row['last_name'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['phone'] . "</td>";
      echo "</tr>";
		}
	}
  echo "</table>";
?>
</body>
</html>