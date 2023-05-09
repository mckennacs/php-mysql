<!--
Chris McKenna
CIS 166AE
Final Project
-->

<?php
// I couldn't get this to work. I tried a few methods, using DOMDocument and Simplexml to read rss files kept giving me HTTP errors
// I looked into using web services but the only documented way to do it I found required a paid API key.
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

