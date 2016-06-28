<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $medicina = $_GET['medicina'];
    $desativo = 0;

    $query = "DELETE FROM medicina WHERE id_medicina = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $medicina);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoMedicina.php?consultaRemovida=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoMedicina.php?consultaRemovidaErro=" . $colaborador);
    }
}