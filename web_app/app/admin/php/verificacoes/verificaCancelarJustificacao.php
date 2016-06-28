<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $justificacao = $_GET['justificacao'];

    $query = "DELETE FROM justificacoes WHERE id_justificacao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $justificacao);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoJustificacoes.php?justificacaoRemovida=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoJustificacoes.php?justificacaoRemovidaErro=" . $colaborador);

    }
}