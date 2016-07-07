<?php

require_once('../../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['publicacao']))) {

    $publicacao = $_GET['publicacao'];

    $ativo = 0;
    $query = "UPDATE projetos SET ativo = ? WHERE id_projetos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $publicacao);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../../projetosAtivos.php?projetoRemovido=" . $publicacao);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../projetosAtivos.php?projetoRemovidoErro=" . $publicacao);

    }

}