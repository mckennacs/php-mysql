<!--
Chris McKenna
CIS 166AE
Final Project
-->

<?php

include_once 'includes/ScottBook.php';
global $conn;
$signup = new ScottBook($conn);
?>
<!-- The project description doesn't specify that we have to validate everything with PHP, so I'm using some client-side validation before cleaning form data up to insert into DB -->
<!-- Using tel, email, etc input types also changes keyboard for mobile devices -->
<!-- https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation -->
<form method="post">
  <fieldset>
    <legend>Sign Up</legend>
    <table>
      <!-- Username -->
      <tr>
        <td>
          <label for="username" id="username">Username: </label>
          <input type="text" id="username" name="username" required>
        </td>
      </tr>
      <!-- Password -->
      <tr>
        <td>
          <label for="password" id="password">Password: </label>
          <input type="password" id="password" name="password" required>
        </td>
      </tr>
      <!-- First Name -->
      <tr>
        <td>
          <label for="first_name" id="first_name">First Name: </label>
          <input type="text" id="first_name" name="first_name" required>
        </td>
      </tr>
      <!-- Last Name -->
      <!--  Not sure why we'd want the user to submit their first/last name and full name, which sounds like the same thing? Will combine before inserting into DB -->
      <tr>
        <td><label for="last_name" id="last_name">Last Name: </label>
          <input type="text" id="last_name" name="last_name" required>
        </td>
      </tr>
      <!-- Email -->
      <tr>
        <td><label for="email" id="email">Email address: </label>
          <input type="email" id="email" name="email" required>
        </td>
      </tr>
      <!-- Phone number -->
      <tr>
        <td>
          <label for="phone" id="phone">Phone number (optional): </label>
          <input type="tel" id="phone" name="phone" pattern="[1-9]{1}[0-9]{2}[-|.]{1}[1-9]{1}[0-9]{2}[-|.]{1}[0-9]{4}">
        </td>
      </tr>
      <tr>
        <td>
          <label for="theme">Select Theme:</label>
          <input type="radio" id="default" name="theme" value="default" required>
          <label for="default">Default</label>
          <input type="radio" id="dark" name="theme" value="dark" required>
          <label for="dark">Dark</label>
          <input type="radio" id="vaporwave" name="theme" value="vaporwave" required>
          <label for="vaporwave">Vaporwave</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" name="submit" value="Submit">
        </td>
      </tr>
    </table>
  </fieldset>
</form>

