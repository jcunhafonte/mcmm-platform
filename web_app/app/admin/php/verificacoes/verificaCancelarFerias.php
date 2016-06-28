<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $ferias = $_GET['ferias'];
    $desativo = 0;

    $query = "DELETE FROM ferias WHERE id_ferias = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $ferias);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoFerias.php?feriasRemovidas=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoFerias.php?feriasRemovidasErro=" . $colaborador);
    }
}