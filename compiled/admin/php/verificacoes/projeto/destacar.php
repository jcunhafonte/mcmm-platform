<?php

require_once('../../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_POST['projeto']))) {

    $projeto = $_POST['projeto'];

    $destacado = 1;
    $query = "UPDATE projetos SET destacado = ? WHERE id_projetos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $destacado, $projeto);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../../projetosDestacados.php?projetoDestacado=" . $projeto);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../projetosDestacados.php?projetoDestacadoErro=" . $projeto);

    }

}