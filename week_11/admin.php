<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
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
<header>
  <nav>
    <ul>
      <li>
        <a href="index.php">Log In</a>
      </li>
      <li>
        <a href="admin.php">Admin</a>
      </li>
      <li>
        <a href="signup-form.php">Sign Up</a>
      </li>
    </ul>
  </nav>
  <h2>Admin</h2>
</header>
<body>

<?php
  // MySQL select statement
  $sql = "SELECT * FROM users;";
  // Uses mysqli_query function to use the $conn mysqli_connect function as defined in dbh.inc.php
  /** @var $conn */
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
      // echo "<td><form action='edit.php' method='GET'><input type='submit' name='" . $row['id'] . "' value='Edit'></form></td>";
      //echo "<td><form action='edit.php' method='GET' class='admin-form'><button>Edit<input type='hidden' name='id' value='" . $row['id'] . "'></button></form>";
      //echo "<form action='delete.php' method='GET' class='admin-form'><button>Delete<input type='hidden' name='id' value='" . $row['id'] . "'></form></td>";
      // DO NOT NEED FORMS, JUST QUERY STRING PARAMETER
      echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
			echo "</tr>";
		}
	}
  echo "</table>";
?>
</body>
</html>
