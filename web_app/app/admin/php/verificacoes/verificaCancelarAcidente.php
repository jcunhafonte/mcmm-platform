<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $acidente = $_GET['acidente'];
    $desativo = 0;

    $query = "DELETE FROM acidentes WHERE id_acidente = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $acidente);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoAcidentes.php?acidenteRemovido=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoMedicina.php?acidenteRemovidoErro=" . $colaborador);
    }
}