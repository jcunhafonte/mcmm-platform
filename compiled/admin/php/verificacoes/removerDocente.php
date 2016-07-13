<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['docente']))) {

    $docente = $_GET['docente'];

    $query = "DELETE FROM docentes WHERE id_docentes = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $docente);

    if (mysqli_stmt_execute($stmt)) {
        
        mysqli_stmt_close($stmt);
        header("location:../../docentes.php?docenteRemovido");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../docentes.php?docenteRemovidoErro");

    }

}