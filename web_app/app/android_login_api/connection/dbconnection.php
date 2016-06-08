<?php

ini_set('display_errors', 'On');

$hostname = "localhost";
$username = "noticias_wesee";
$password = "wesee2015!";
$bd = "noticias_wesee";

$link = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link,"utf8");

$hostname = "localhost";
$username = "noticias_wesee";
$password = "wesee2015!";
$bd = "noticias_wesee";

$link2 = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link2,"utf8");

?>