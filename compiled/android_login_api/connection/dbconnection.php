<?php

ini_set('display_errors', 'On');

$hostname = "localhost";
$username = "root";
$password = "Saskatoon0708PM";
$bd = "mcmm_platform";

$link = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link,"utf8");

$hostname = "localhost";
$username = "root";
$password = "Saskatoon0708PM";
$bd = "mcmm_platform";

$link2 = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link2,"utf8");

?>