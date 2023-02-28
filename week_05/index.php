<!--
Chris McKenna
CIS 166AE
Module 6 Assignment
Part A
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contrasting Colors</title>
  <style>
    p {
      font-family: "Comic Sans MS", sans-serif;
      font-size: xx-large;
      margin: 4rem;
    }

    /*Some formatting so you can read the link when changing colors*/
    a {
      text-decoration: none;
      background-color: #fff;
      color: #000;
      padding: 1%;
      border: 1px solid #000000;
    }

  </style>
</head>
<body>
<?php

	// Associative array of contrasting color pairs by hex #
	$contrast_colors = [
		'#ff00ae' => '#111731',
		'#961eae' => '#b6f2e8',
    '#9afe9c' => '#7514d7',
		'#a9f282' => '#012d26',
		'#f7c0c0' => '#470986'
	];

  // Assign $text_color to a random key from $contrast_colors using array_rand()
  $text_color = array_rand($contrast_colors);
  // Assign $background_color to the value matching the $text_color key
  $background_color = $contrast_colors[$text_color];


  // Based on https://www.quora.com/How-can-I-add-a-background-color-main-page-with-the-use-of-PHP
  echo "<body style='background-color: $background_color; color: $text_color;'>";

?>
<!--Text from promo by wrestler Scott Steiner https://youtu.be/msDuNZyYAIQ-->
<p>You know they say that all men are created equal, but you look at me, and you look at Samoa Joe and you can see that statement is not true. See, normally if you go one on one with another wrestler, you got a 50/50 chance of winning.</p>
<p>But I'm a genetic freak and I'm not normal! So you got a 25%, AT BEST, at beat me. Then you add Kurt Angle to the mix, your chances of winning drastic go down.</p>
<p>See the 3 way at Sacrifice, you got a 33 1/3 chance of winning, but I, I got a 66 and 2/3 chance of winning, because Kurt Angle KNOWS he can't beat me and he's not even gonna try!</p>
<p>So Samoa Joe, you take your 33 1/3 chance, minus my 25% chance and you got an 8 1/3 chance of winning at Sacrifice. But then you take my 75% chance of winning, if we was to go one on one, and then add 66 2/3 per cents, I got 141 2/3 chance of winning at Sacrifice. See Joe, the numbers don't lie, and they spell disaster for you at Sacrifice.</p>
<p><a href="https://genius.com/Scott-steiner-steiner-math-annotated">- Scott Steiner</a></p>
</body>
</html>