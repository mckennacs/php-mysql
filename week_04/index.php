<!--
Chris McKenna
CIS 166AE
Module 5 Assignment
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Arrays</title>
</head>
<body>

<?php

//  Array of 10 colors
	$colors = [
		'red',
		'blue',
		'green',
		'yellow',
		'purple',
		'orange',
		'violet',
		'indigo',
		'teal',
		'fuchsia',
		'coral'
  ];

//  Output items 1, 4, 6, 9
	echo $colors[0] . '<br />';
	echo $colors[3] . '<br />';
	echo $colors[5] . '<br />';
	echo $colors[8] . '<br />';

//  Associative array with color names and hex codes
//	Color names and hex codes from https://htmlcolorcodes.com/color-names/
	$hex_colors = [
		'Tomato' => '#FF6347',
		'RebeccaPurple' => '#663399',
		'MediumSpringGreen' => '#00FA9A',
		'Goldenrod' => '#DAA520',
    'BurlyWood' => '#DEB887'
	];

//  Sort $hex_colors by key
  ksort($hex_colors);

//  Create an array of sorted $hex_colors keys to access the 2nd and 4th items - https://www.geeksforgeeks.org/how-to-access-an-associative-array-by-integer-index-in-php/
  $hex_index = array_keys($hex_colors);

//  Output 2nd and 4th items in $hex_colors
	echo '<p style="color:' . $hex_colors[$hex_index[1]] . '">Color 2: '. $hex_index[1] . '- Hex code: ' . $hex_colors[$hex_index[1]] . '</p>';
  echo '<p style="color:' . $hex_colors[$hex_index[3]] . '">Color 4: '. $hex_index[3] . '- Hex code: ' . $hex_colors[$hex_index[3]] . '</p>';

  echo '<h3>Loops:</h3>';
  echo '<p><b>Items in $colors array: </b></p>';
//  Loop through $colors array and output items
  foreach ($colors as $color) {
    echo '<p>' . $color . '</p>';
  }

  echo '<p><b>Items in $hex_colors array sorted by key in ascending order: </b></p>';
//  Loop through $hex_colors, styling text with hex colors
  foreach ($hex_colors as $hex_color => $hex_value) {
    echo '<p style="color:' . $hex_value . '"> ' . $hex_color . ' - '. $hex_value . '</p>';
  }

// Sort $hex_colors by values in descending order
  echo '<p><b>Items in $hex_colors array sorted by values in descending order: </b></p>';
  arsort($hex_colors);

  foreach ($hex_colors as $hex_color => $hex_value) {
    echo '<p style="color:' . $hex_value . '"> ' . $hex_color . ' - '. $hex_value . '</p>';
  }

?>
</body>
</html>
