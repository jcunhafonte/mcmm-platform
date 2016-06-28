<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

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

   $query = "INSERT INTO justificacoes(ref_id_colaborador, motivo, data_justificacao, fim_justificacao) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'isss', $nomeJustificacao, $adicionarMotivoJustificacao, $novaDataJustificacao, $novaDataJustificacaoFim);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header('location:../../adicionarJustificacoes.php?sucesso='.$nomeJustificacao);
    }else{
        mysqli_stmt_close($stmt);
        header('location:../../adicionarJustificacoes.php?erro='.$nomeFerias);
    }
}