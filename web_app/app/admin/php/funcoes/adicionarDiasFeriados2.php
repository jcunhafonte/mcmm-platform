<?php

session_start();

require("../connection/dbconnection.php");

if (isset($_POST['choice1']) && isset($_POST['choice2']) && isset($_POST['choice3'])) {

    if (isset($_POST['choice1'])) {

        $insercaoDataFeriado = $_POST['choice1'];
        $insercaoDataFeriado = strtotime($insercaoDataFeriado);
        $novaInsercaoDataFeriado = date('Y-m-d', $insercaoDataFeriado);

    } else {
        $novaInsercaoDataFeriado = NULL;
    }

    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];

// Atualizar na DB data da última visita
    $query = "UPDATE nao_uteis  SET descricao = ?, data_dia = ? WHERE id_nao_uteis = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $choice2, $novaInsercaoDataFeriado, $choice3);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

}