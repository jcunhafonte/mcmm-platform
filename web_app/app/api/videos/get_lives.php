<?php

include '../connection/mysql.php';

$stmt = $conn->prepare("SELECT tema FROM transmissoes WHERE tema = ?");

$city = "ev";

$stmt->bind_param("s", $city);
$stmt->execute();
$stmt->bind_result($district);
$stmt->fetch();
$stmt->close();

printf("%s is in district %s\n", $city, $district);

/* close connection */
$conn->close();