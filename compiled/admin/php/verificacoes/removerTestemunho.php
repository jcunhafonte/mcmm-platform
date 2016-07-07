<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['testemunho']))) {

    $testemunho = $_GET['testemunho'];

    $query = "DELETE FROM testemunhos WHERE id_testemunhos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $testemunho);

    if (mysqli_stmt_execute($stmt)) {
        
        mysqli_stmt_close($stmt);
        header("location:../../testemunhos.php?testemunhoRemovido");

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../testemunhos.php?testemunhoRemovido");

    }

}