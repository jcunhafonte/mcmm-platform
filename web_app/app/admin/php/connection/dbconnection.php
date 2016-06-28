<?php

ini_set('display_errors', 'On');

$hostname = "localhost";
$username = "bentoena_RH123";
$password = "bentoena_RH123";
$bd = "bentoena_RH";

$link = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link,"utf8");

$hostname = "localhost";
$username = "bentoena_RH123";
$password = "bentoena_RH123";
$bd = "bentoena_RH";

$link2 = mysqli_connect($hostname, $username, $password, $bd);
mysqli_set_charset($link2,"utf8");

?>