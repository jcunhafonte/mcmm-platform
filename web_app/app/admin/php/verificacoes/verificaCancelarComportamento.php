<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $comportamento = $_GET['comportamento'];

    $query = "DELETE FROM comportamentos WHERE id_comportamentos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $comportamento);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoComportamentos.php?comportamentoRemovido=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoComportamentos.php?comportamentoRemovidoErro=" . $colaborador);

    }
}