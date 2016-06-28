<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador']))) {

    $colaborador = $_GET['colaborador'];

    $query = "DELETE FROM desvinculacao WHERE id_desvinculacao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_GET['desvinculacao']);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../registoEntrevistasDesvinculacao.php?entrevistaRemovida=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoEntrevistasDesvinculacao.php?entrevistaRemovidaErro=" . $colaborador);

    }
}