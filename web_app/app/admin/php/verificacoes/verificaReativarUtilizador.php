<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['utilizador'])) AND (!isset($_GET['perfil']))) {

    $utilizador = $_GET['utilizador'];
    $ativo = 1;

    $query = "UPDATE utilizadores SET ativo = ? WHERE id_utilizador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $utilizador);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../utilizadoresDesativos.php?utilizadorReativo=" . $utilizador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../utilizadoresDesativos.php?utilizadorReativoErro=" . $utilizador);

    }

}

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['utilizador'])) AND (isset($_GET['perfil']))) {

    $utilizador = $_GET['utilizador'];
    $ativo = 1;

    $query = "UPDATE utilizadores SET ativo = ? WHERE id_utilizador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $utilizador);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../../perfil.php?utilizador=" . $utilizador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../perfil.php?utilizador=" . $utilizador);

    }

}