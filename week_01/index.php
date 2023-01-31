<!DOCTYPE html>
<html lang="en">
<body>
<h1>Module 2 Assignment</h1>
<?php
//Displays name:
echo "Chris McKenna";

//Prints today's date. Year has 4 digits, month and day don't have leading 0s
echo "<p>Today's date: ".date("n/j/Y")."</p>";

//Gives current time in 12 hour form in the Arizona time zone: https://www.php.net/manual/en/function.date-default-timezone-set.php
date_default_timezone_set('America/Phoenix');
echo "<p>Current time: ".date("h:i a T")."</p>";

//Gives the date and time 1 week in the future
echo "Time in 1 week: ". date("n/j/Y h:i a T", strtotime("+1 week"));

//Days since 1/1/23 using date_diff() https://www.tutorialspoint.com/php/php_function_date_diff.htm
$jan_1 = date_create("1/1/2023");
$current_date = date_create();
$days_since_jan_1 = date_diff($jan_1 , $current_date);
echo "<p>";
echo ($days_since_jan_1 ->format("%d days since 1/1/2023 </p>"));

// Weeks until spring graduation, 05/12/23 https://thisinterestsme.com/php-difference-weeks/
// Sets graduation and current dates
$graduation_date = date_create("5/12/2023");

// Gets difference in days and divides by 7, rounding down with floor();
$days_until_graduation = date_diff($graduation_date, $current_date)->days;
$weeks_until_graduation = $days_until_graduation / 7;
echo (floor($weeks_until_graduation)." weeks until graduation day (5/12/2023)");


?>

</body>
</html>