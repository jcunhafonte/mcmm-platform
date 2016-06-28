<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['justificacao'])) ) {

    $justificacao = $_GET['justificacao'];

    if (isset($_POST['adicionarNomeJustificacao'])) {
        $nomeJustificacao = $_POST['adicionarNomeJustificacao'];
    } else {
        $nomeJustificacao = NULL;
    }

    if (isset($_POST['dataJustificacao'])) {
        $dataJustificacao = $_POST['dataJustificacao'];
        $dataJustificacao = strtotime($dataJustificacao);
        $novaDataJustificacao = date('Y-m-d H:i:s', $dataJustificacao);
    } else {
        $novaDataJustificacao = NULL;
    }

    if (isset($_POST['adicionarMotivoJustificacao'])) {
        $adicionarMotivoJustificacao = $_POST['adicionarMotivoJustificacao'];
    } else {
        $adicionarMotivoJustificacao = NULL;
    }

    if (isset($_POST['dataJustificacaoFim'])) {
        $dataJustificacaoFim = $_POST['dataJustificacaoFim'];
        $dataJustificacaoFim = strtotime($dataJustificacaoFim);
        $novaDataJustificacaoFim = date('Y-m-d H:i:s', $dataJustificacaoFim);
    } else {
        $novaDataJustificacaoFim = NULL;
    }

    $query = "UPDATE justificacoes SET ref_id_colaborador = ?, motivo = ?, data_justificacao = ?,
 fim_justificacao = ? WHERE id_justificacao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssssi', $nomeJustificacao, $adicionarMotivoJustificacao, $novaDataJustificacao, $novaDataJustificacaoFim,
        $justificacao);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarJustificacao.php?sucesso=$nomeJustificacao&justificacao=$justificacao");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarJustificacao.php?erro=$nomeJustificacao&justificacao=$justificacao");
    }
}