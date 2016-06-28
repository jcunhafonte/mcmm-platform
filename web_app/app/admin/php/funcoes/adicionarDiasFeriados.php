<?php

session_start();

require("../connection/dbconnection.php");

if (isset($_POST['choice1']) && isset($_POST['choice2'])) {

    if (isset($_POST['choice1'])) {

        $insercaoDataFeriado = $_POST['choice1'];
        $insercaoDataFeriado = strtotime($insercaoDataFeriado);
        $novaInsercaoDataFeriado = date('Y-m-d', $insercaoDataFeriado);

    } else {
        $novaInsercaoDataFeriado = NULL;
    }

    $choice2 = $_POST['choice2'];

// Atualizar na DB data da última visita
    $query = "INSERT INTO nao_uteis (descricao, data_dia) VALUES (?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $choice2, $novaInsercaoDataFeriado);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

}