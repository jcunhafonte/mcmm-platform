<?php

session_start();

require("../connection/dbconnection.php");

if (isset($_POST['choice1'])) {

    $choice1 = $_POST['choice1'];

// Atualizar na DB data da última visita
    $query = "UPDATE dias_ferias SET numero = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $choice1);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

}