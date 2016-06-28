<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $contrato = $_GET['contrato'];

    $query = "DELETE FROM contrato WHERE id_contrato = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $contrato);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoContratos.php?contratoRemovido=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoContratos.php?contratoRemovidoErro=" . $colaborador);

    }
}