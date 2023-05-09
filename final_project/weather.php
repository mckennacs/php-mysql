<!--
Chris McKenna
CIS 166AE
Final Project
-->

<?php
//DOMDocument() older?
// https://bavotasan.com/2010/display-rss-feed-with-php/
// https://www.php.net/manual/en/class.domdocument.php

// Simplexml
// https://makitweb.com/how-to-read-rss-feeds-using-php/
// https://www.w3schools.com/php/php_ref_simplexml.asp
// https://www.w3schools.com/php/func_simplexml_load_file.asp

// Sky Harbor RSS weather feed - https://w1.weather.gov/xml/current_obs/KPHX.rss

// https://www.visualcrossing.com/resources/documentation/weather-api/how-to-load-weather-data-in-php/

// https://www.weather.gov/gis/WebServices

$url = urlencode("https://w1.weather.gov/xml/current_obs/KPHX.xml");
$rss = simplexml_load_file($url, null, LIBXML_NOCDATA);
print_r($rss);

