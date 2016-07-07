<?php

$hostname = "localhost";
$username = "root";
$password = "Saskatoon0708PM";
$bd = "mcmm_platform";

$link = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link,"utf8");