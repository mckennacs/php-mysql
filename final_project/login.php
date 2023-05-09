<?php
  session_start();
  include_once 'includes/ScottBook.php';
  global $conn;
  $login = new ScottBook($conn);
  $theme = $login->getValidUserTheme();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="css/<?php echo $theme ?>.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--  TODO: Dynamically update title with php  -->
  <title>Title</title>
</head>

<body>
<!-- Header -->
<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/menu.php' ?>

<!-- Main -->
<main>
  <fieldset>
    <legend>Log In</legend>
    <form method="post">
      <table>
        <tr>
          <td>
            <label for="username" id="username">Username</label>
            <input type="text" id="username" name="username">
          </td>
        </tr>
        <tr>
          <td>
            <label for="password" id="password">Password</label>
            <input type="password" id="password" name="password">
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="submit" value="Submit">
          </td>
        </tr>
      </table>
    </form>
  </fieldset>
  <?php
    if(isset($_POST['submit'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $login->authenticate($username, $password);
    }
  ?>
</main>
<!-- Footer -->
</body>
<?php include 'includes/footer.php' ?>

</html>