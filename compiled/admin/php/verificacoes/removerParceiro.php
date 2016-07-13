<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['parceiro']))) {

    $parceiro = $_GET['parceiro'];

    $query = "DELETE FROM parceiros WHERE id_parceiros = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $parceiro);

    if (mysqli_stmt_execute($stmt)) {
        
        mysqli_stmt_close($stmt);
        header("location:../../parceiros.php?parceiroRemovido");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../parceiros.php?parceiroRemovidoErro");

    }

}