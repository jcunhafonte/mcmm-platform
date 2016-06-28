<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['transmissao'])) AND (!isset($_GET['perfil']))) {

    $transmissao = $_GET['transmissao'];
    $ativo = 0;

    $query = "UPDATE transmissoes SET ativo = ? WHERE id_transmissao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $transmissao);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../transmissoesAtivas.php?transmissaoRemovida=" . $transmissao);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../transmissoesAtivas.php?transmissaoRemovidaErro=" . $transmissao);

    }

}

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['transmissao'])) AND (isset($_GET['perfil']))) {

    $transmissao = $_GET['transmissao'];
    $ativo = 0;

    $query = "UPDATE transmissoes SET ativo = ? WHERE id_transmissao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $transmissao);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../../transmissao.php?transmissao=" . $transmissao);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../../transmissao.php?transmissao=" . $transmissao);

    }

}