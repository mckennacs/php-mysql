<!--
Chris McKenna
CIS 166AE
Module 6 Assignment
Part B
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Module 6 Assignment</title>
  <style>

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
    }

    td {
      padding: 1%;
    }

    table, tr, td, th {
      border: 1px solid black;
    }

    th {
      height: 10%;
      padding: 1%;
      /*border: 1px solid #000;*/
      background-color: gray;
    }
  </style>
</head>
<body>

<?php

	$people = [
		'1205' => [
			'name' => 'John Smith',
			'phone' => '555-1121',
			'email' => 'John.Smith@gmail.com',
			'age' => 52,
			'total_purchases' => 2,
			'average_spent' => '55.76'
		],
		'2500' => [
			'name' => 'Fred Jones',
			'phone' => '555-1114',
			'email' => 'smithy@gmail.com',
			'age' => 49,
			'total_purchases' => 5,
			'average_spent' => '155.24'
		],
		'8026' => [
			'name' => 'Susan Rademew',
			'phone' => '555-1311',
			'email' => 'deadpool344@gmail.com',
			'age' => 18,
			'total_purchases' => 21,
			'average_spent' => '65.43'
		],
		'3687' => [
			'name' => 'Joe Larette',
			'phone' => '555-1116',
			'email' => 'yankeesfan536@gmail.com',
			'age' => 35,
			'total_purchases' => 12,
			'average_spent' => '15.24'
		],
		'1008' => [
			'name' => 'Mary Friedstin',
			'phone' => '555-1911',
			'email' => 'Mary3448@gmail.com',
			'age' => 20,
			'total_purchases' => 9,
			'average_spent' => '33.42'
		],
	];

  // Sorts $people by key - ID number
  ksort($people);

  echo "<table>";

  // Creates array $headings from the keys of the first array in $people
  $headings = array_keys($people['1205']);

  // Loops through $headings array to create HTML <th> elements for each item
  foreach ($headings as $heading) {
    echo "<th>". $heading ." </th>";
  }

	foreach($people as $key => $value) {
    // Creates rows for each person in table based on items in $people
    echo "<tr>";

    // Creates <td> elements for each value in sub-arrays
    foreach ($value as $sub_key => $sub_value) {
      echo "<td>$sub_value</td>";
    }
    echo "</tr>";
  }
  echo "</table>";


  // Creates array from the primary keys of $people
  $id_numbers = array_keys($people);

  //Outputs items from $id_numbers by accessing their index in array
  echo "<ul>";
  echo "<h3>ID Numbers:</h3>";
  echo "<li>" . $id_numbers[0] . "</li>";
  echo "<li>" . $id_numbers[1] . "</li>";
  echo "<li>" . $id_numbers[2] . "</li>";
  echo "<li>" . $id_numbers[3] . "</li>";
  echo "<li>" . $id_numbers[4] . "</li>";
  echo "</ul>";
?>
</body>
</html>