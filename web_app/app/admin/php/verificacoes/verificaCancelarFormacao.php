<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $formacao = $_GET['formacao'];
    $desativo = 0;

    $query = "DELETE FROM formacoes WHERE id_formacoes = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $formacao);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoFormacoes.php?formacaoRemovida=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoFormacoes.php?formacaoRemovidaErro=" . $colaborador);
    }
}