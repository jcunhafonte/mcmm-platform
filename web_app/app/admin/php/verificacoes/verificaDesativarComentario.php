<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['comentario'])) AND (!isset($_GET['perfil']))) {

    $comentario = $_GET['comentario'];
    
    $query = "DELETE FROM comentarios_transmissoes WHERE id_comentarios_transmissoes = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $comentario);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../comentarios.php?comentarioRemovido=" . $comentario);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../comentarios.php?comentarioRemovidoErro=" . $comentario);

    }

}

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['comentario'])) AND (isset($_GET['perfil']))) {

    $comentario = $_GET['comentario'];

    $query = "DELETE FROM comentarios_transmissoes WHERE id_comentarios_transmissoes = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $comentario);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../../comentarios.php?comentario=" . $comentario);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../comentarios.php?comentario=" . $comentario);

    }

}