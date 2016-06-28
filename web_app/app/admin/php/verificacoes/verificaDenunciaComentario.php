<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['denuncia'])) AND (!isset($_GET['perfil']))) {

    $denuncia = $_GET['denuncia'];
    
    //$query = "DELETE FROM comentarios_denuncias_transmissoes WHERE comentarios_denuncias_transmissoes.ref_id_comentario = ?";
    $query = "DELETE FROM comentarios_denuncias_transmissoes  WHERE comentarios_denuncias_transmissoes.ref_id_comentario = ?";
    $query2 = "DELETE FROM comentarios_transmissoes WHERE comentarios_transmissoes.id_comentarios_transmissoes = ?";
    
    $stmt = mysqli_prepare($link, $query);
    $stmt2 = mysqli_prepare($link, $query2);
    mysqli_stmt_bind_param($stmt, 'i', $denuncia);
    mysqli_stmt_bind_param($stmt2, 'i', $denuncia);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt);

        header("location:../../gerirDenuncias.php?comentarioRemovido=" . $denuncia);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../gerirDenuncias.php?comentarioRemovidoErro=" . $denuncia);

    }

}

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['denuncia'])) AND (isset($_GET['perfil']))) {

    $denuncia = $_GET['denuncia'];

    $query = "DELETE FROM comentarios_denuncias_transmissoes  WHERE comentarios_denuncias_transmissoes.ref_id_comentario = ?";
    $query2 = "DELETE FROM comentarios_transmissoes WHERE comentarios_transmissoes.id_comentarios_transmissoes = ?";
    
    $stmt = mysqli_prepare($link, $query);
    $stmt2 = mysqli_prepare($link, $query2);
    mysqli_stmt_bind_param($stmt, 'ii', $denuncia);
    mysqli_stmt_bind_param($stmt2, 'ii', $denuncia);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt);

        header("location:../../../gerirDenuncias.php?comentario=" . $denuncia);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../gerirDenuncias.php?comentario=" . $denuncia);

    }

}