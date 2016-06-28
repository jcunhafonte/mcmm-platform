<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['colaborador'])) AND
    (!isset($_GET['perfil']))) {

    $colaborador = $_GET['colaborador'];
    $mudanca = $_GET['mudanca'];

    $query = "SELECT historico_funcao, historico_vencimento FROM mudancas WHERE id_mudanca = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $mudanca);
    mysqli_stmt_bind_result($stmt, $historicoFuncao, $historicoVencimento);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $query = "UPDATE colaborador SET vencimento_base = ?, funcao = ? WHERE id_colaborador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $historicoVencimento, $historicoFuncao, $colaborador);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $query = "DELETE FROM mudancas WHERE id_mudanca = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $mudanca);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        header("location:../../registoMudancas.php?mudancaRemovido=" . $colaborador);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../registoMudancas.php?mudancaRemovidoErro=" . $colaborador);

    }
}