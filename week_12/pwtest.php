<?php
global $conn;
include 'includes/LoginBox.php';

$u_name = 'jlpipes';
$pwd = 'engage';
$first = 'Jean-Luc';
$last = 'Picard';
$email = 'jl@enterprise.biz';
$phone = '555-555-5555';

$sql = "INSERT INTO users (name, password, first_name, last_name, email, phone)
            VALUES ('$u_name', MD5('$pwd'), '$first', '$last', '$email', '$phone');";
mysqli_query($conn, $sql);