<!--
Chris McKenna
CIS 166AE
Module 7 Assignment
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Module 7 Assignment</title>
</head>
<body>
<?php
  // Shows form on first page load
  $showForm = TRUE;

	if (isset($_POST["submit"])) {
    $page = $_SERVER['PHP_SELF'];
    $first_name = $_POST["first"];
    $last_name = $_POST["last"];
    $phone_number = $_POST["phone"];
    $email = $_POST["email"];
    $b_day = $_POST["day"];
    $b_month = $_POST["month"];
    $b_year = $_POST["year"];
    $comment = $_POST["comment"];

    // Converts first and last names to lowercase, concatenates into string $name_result which uses ucwords to capitalize the first letter of each word
    $first_name = strtolower($_POST["first"]);
    $last_name = strtolower($_POST["last"]);
    $name_result = ucwords($first_name . " " . $last_name). "<br />";

    // Function to validate phone number using regular expressions
    function validate_phone($phone_number): string
    {
      $valid_phone_pattern = '^[1-9]{1}[0-9]{2}[-|.]{1}[1-9]{1}[0-9]{2}[-|.]{1}[0-9]{4}';
      if (preg_match("/$valid_phone_pattern/", $phone_number)) {
        // If valid, prints phone number
        $phone_result = "<p>" . $phone_number . "</p>";
      } else {
        // If invalid, prints error message
        $phone_result = "<p  style=\"color: red\">Enter phone number as 555-555-5555 OR 555.555.5555</p>";
      }
      return $phone_result;
    }

    // Outputs string $name_result with capitalized first letters
    echo $name_result;

    // Calls validate_phone function using the $phone_number input
    $valid_phone = validate_phone($phone_number);
    echo $valid_phone;

    // Combines $b_day $b_month and $b_year into single string
    $birth_date = $b_day . "." . $b_month . "." . $b_year;

    // Uses checkdate to pass $b_month, $b_day, and $b_year (converted to integers) to check if birthdate entered is valid
    if(!checkdate((int)$b_month, (int)$b_day, (int)$b_year)){
      print "<p style=\"color: red\">The birthdate you entered <em>" . $birth_date . "</em> is not a valid date.</p>";
    } else {
      // Formats $birth_date
      $d = strtotime($birth_date);
      print "<p> Birth date: " . date("d.m.Y.", $d) . "</p>";
    }

    // Uses filter_var FILTER_VALIDATE_EMAIL to check if $email is a valid address.
    // https://www.w3schools.com/php/php_form_url_email.asp
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      print "<p style=\"color: red\">The email you entered <em>" . $email . "</em> is not a valid address.</p>";
    } else {
      print "<a href=\"mailto: %s\">$email</a>";
    }

    // Uses str_ireplace to replace "Estrella Mountain" in $comment as "EMCC"
    $emcc_replace = str_ireplace("Estrella Mountain","EMCC", $comment);
    echo "<p>". $emcc_replace . "</p>";

    // Creates link to reload form using $_SERVER['PHP_SELF'] as $page
    // https://stackoverflow.com/a/57512761
    print "<p><a href=\"$page\">Reload page</a></p>";

    // Hides form after submit
    $showForm = FALSE;
  }

	if ($showForm) {
    // Includes separate form.php file with form HTML
    include('form.php');
  }

?>
</body>
</html>