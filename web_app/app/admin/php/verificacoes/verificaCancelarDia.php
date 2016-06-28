<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $dia = $_GET['dia'];
    $desativo = 0;

    $query = "DELETE FROM nao_uteis WHERE id_nao_uteis = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $dia);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../configuracoes.php?diaRemovido=" . $dia);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../configuracoes.php?diaRemovidoErro=" . $dia);
    }
}