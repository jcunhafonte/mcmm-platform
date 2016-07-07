<?php

ini_set('display_errors', 'On');

$hostname = "localhost";
$username = "root";
$password = "Saskatoon0708PM";
$bd = "mcmm_platform";

$conn = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($conn,"utf8");

$conn2 = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($conn2,"utf8");