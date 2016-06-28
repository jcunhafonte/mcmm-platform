<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['marcacao'])) AND
    (!isset($_GET['perfil']))) {

    $marcacao = $_GET['marcacao'];
    $colaborador = $_GET['colaborador'];

    $query = "DELETE FROM marcacao_consulta WHERE id_marcacao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $marcacao);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoMarcacoes.php?marcacaoRemovida=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoMarcacoes.php?marcacaoRemovidaErro=" . $colaborador);

    }
}