<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $ativo = 1;

    $query = "UPDATE colaborador SET ativo = ?, processo_saida = 'NULL' WHERE id_colaborador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $colaborador);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        $query = "UPDATE contrato SET atual = 1 WHERE ref_id_colaborador = ? ORDER BY data_contrato DESC LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'i', $colaborador);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        header("location:../../antigosColaboradores.php?contratoReativo=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../antigosColaboradores.php?contratoReativoErro=" . $colaborador);

    }

}

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $ativo = 1;

    $query = "UPDATE colaborador SET ativo = ?, processo_saida = 'NULL' WHERE id_colaborador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $ativo, $colaborador);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../perfilColaborador.php?colaborador=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../perfilColaborador.php?colaborador=" . $colaborador);

    }

}