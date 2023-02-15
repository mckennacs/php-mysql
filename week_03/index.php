<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>FORM</title>
  </head>
<body>
<!--Form to collect first name, last name, e-mail and comments -->
  <form action="" method="post">
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

    //  Checks if there are values in $_POST array then assigns them to variables if they exist
    if (empty($_POST["firstname"])) {
      echo "Please enter your first name." . "<br />";
    }
    elseif (empty($_POST["lastname"])) {
      echo "Please enter your last name." . "<br />";
    }
    elseif (empty($_POST["age"])) {
      echo "Please enter your age." . "<br />";
    }
    elseif (empty($_POST["email"])) {
      echo "Please enter your email address" . "<br />";
    }
    elseif (empty($_POST["comments"])) {
      echo "Please enter a comment" . "<br />";
    }
    else {
      $firstname = $_POST["firstname"];
      $lastname = $_POST["lastname"];
      $age = $_POST["age"];
      $email = $_POST["email"];
      $comments = $_POST["comments"];
      echo "First name: " . $firstname . "<br />";
      echo "Last name: " . $lastname . "<br />";
      echo "Age: " . $age . "<br />";
      echo "Email: " . $email . "<br />";
      echo "Comments: " . $comments . "<br />";
    }
    
    // Switch presenting 3 custom greetings depending on $firstname and a default
    switch($firstname) {
      case "Scott": 
        echo "Hi Scott! Everything is working as intended" . "<br />";
        break;

      case "Chris":
        echo "I hope this works!" . "<br />";
        break;

      case "Homer":
        echo "Feelin fine." . "<br />";
        break;

      default:
        echo "Hello " . $firstname . "<br />";
    }

    // Checks if age entered is an integer, displays message if not. If it is a valid age it then calculates years until retirement.
    if (is_numeric($age)) {
      // Sets constant for retirement age at 65
      define("RETIREMENT_AGE", 65);
      // Sets current year
      $current_year = 2023;
      // If $age is over 65, displays message telling them they are past retirement age
      if ($age == RETIREMENT_AGE) {
        echo "You can retire!" . "<br />";
      // If the $age is 65, displays a message telling user they are old enough to retire.
      }
      elseif ($age > RETIREMENT_AGE) {
        echo "You are already past retirement age." . "<br />";
      }
      else {
        echo "You were born in " . ($current_year - $age) . "<br />";
        echo RETIREMENT_AGE - $age . " years until retirement <br />";
      }
    }
    else {
      echo "Enter age as a number" . "<br />";
    }

    ?>
</body>
</html>

