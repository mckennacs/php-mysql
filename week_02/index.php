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
        <td>E-mail: </td>
        <td><input type="text" name="email"></td>
      </tr>
      <tr>
        <td>Comments:</td>
        <td><input type="text" name="comment"></td>
      </tr>
      <tr>
        <td>Submit </td>
        <td><input type="submit" value="Submit"></td>
      </tr>
    </table>
  </form>
</body>
</html>