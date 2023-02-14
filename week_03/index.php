<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>FORM</title>
  </head>
<body>
<!--Form to collect first name, last name, e-mail and comments -->
  <form action="confirm.php" method="post">
    <table>
      <tr>
        <td>First Name: </td>
        <td><input type="text" name="firstname"></td>
      </tr>
      <tr>
        <td>Last Name: </td>
        <td><input type="text" name="lastname"></td>
      </tr>
      <tr>
        <td>Age: </td>
        <td><input type="text" name="age"></td>
      </tr>
      <tr>
        <td>E-mail: </td>
        <td><input type="text" name="email"></td>
      </tr>
      <tr>
        <td>Comments:</td>
        <td><input type="text" name="comments"></td>
      </tr>
      <tr>
        <td>Submit </td>
        <td><input type="submit" value="Submit"></td>
      </tr>
    </table>
  </form>

  <?php

  // Sets constant for retirement age at 65
      define("RETIREMENTAGE", 65);

  //  Checks if there are values in $_POST array then assigns them to variables if they exist
    
    if (empty($_POST["firstname"])) {
      echo "Please enter your first name." . "<br />";
    } elseif (empty($_POST["lastname"])) {
      echo "Please enter your last name." . "<br />";
    } elseif (empty($_POST["age"])) {
      echo "Please enter your age." . "<br />";
    } elseif (empty($_POST["email"])) {
      echo "Please enter your email address" . "<br />";
    } elseif (empty($_POST["comments"])) {
      echo "Please enter a comment" . "<br />";
    } else {
      $firstname = $_POST["firstname"];
      $lastname = $_POST["lastname"];
      $age = $_POST["age"];
      $email = $_POST["email"];
      $comments = $_POST["comments"];
    }
    
    
    switch($firstname) {
      case "Scott": 
        echo "Hi Scott! Everything is working as intended";
        break;

      case "Chris":
        echo "Please work.";
        break;

      case "Homer":
        echo "Feelin fine.";
        break;
    }

    ?>
</body>
</html>
