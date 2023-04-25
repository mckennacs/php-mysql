<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<!DOCTYPE html>
<html lang="en">
<?php
	include_once 'includes/dbh.inc.php';
  include_once 'includes/LoginBox.php';
	/** @var $conn */
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
  $sql = "SELECT * FROM users WHERE id = " . $_GET['id'] . ";";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
?>

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
  <h2>Edit <?php echo $row['name']; ?></h2>
</header>
<body>

<?php
  // echo $_GET['id'];
  // $sql = "SELECT * FROM users WHERE id = " . $_GET['id'] . ";";
  // $result = mysqli_query($conn, $sql);
  // $resultCheck = mysqli_num_rows($result);
  // $row = mysqli_fetch_assoc($result);

  if ($resultCheck > 0) {
    // TODO change action to update.php
    $form = "<form action='update.php' method='POST'>";
    $form.= '<label for="username" id="username" class="form-field">Username:</label><br />
				<input type="text" id="username" name="username" class="form-field" placeholder=' . $row['name'] . '><br />';
    $form .= '<label for="password" id="password" class="form-field">Password:</label><br />
				<input type="password" id="password" name="password" class="form-field" placeholder=' . $row['password'] . '><br />';
    $form .= '<label for="first-name" id="first-name" class="form-field">First Name:</label><br />
				<input type="text" id="first-name" name="first-name" class="form-field" placeholder=' . $row['first_name'] . '><br />';
    $form .= '<label for="last-name" id="last-name" class="form-field">Last Name:</label><br />
				<input type="text" id="last-name" name="last-name" class="form-field" placeholder=' . $row['last_name'] . '><br />';
    $form .= '<label for="email" id="email" class="form-field">Email Address:</label><br />
				<input type="text" id="email" name="email" class="form-field" placeholder=' . $row['email'] . '><br />';
    $form .= '<label for="phone" id="phone" class="form-field">Phone Number:</label><br />
				<input type="text" id="phone" name="phone" class="form-field" placeholder=' . $row['phone'] . '><br />';
    $form .= '<input type ="hidden" id="id" name="id" value="'. $_GET['id'] .'">';
    $form .= '<input type="submit" id="submit" name="submit" value="Edit User">';

    echo $form;
  }


?>

</body>
</html>
