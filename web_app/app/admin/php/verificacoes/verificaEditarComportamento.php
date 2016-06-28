<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['comportamento'])) ) {

    $comportamento = $_GET['comportamento'];

    if (isset($_POST['adicionarColaboradorComportamento'])) {
        $colaboradorComportamento = $_POST['adicionarColaboradorComportamento'];
    } else {
        $colaboradorComportamento = NULL;
    }

    if (isset($_POST['dataComportamento'])) {
        $dataComportamento = $_POST['dataComportamento'];
        $dataComportamento = strtotime($dataComportamento);
        $novaDataComportamento = date('Y-m-d H:i:s', $dataComportamento);
    } else {
        $novaDataComportamento = NULL;
    }

    if (isset($_POST['descricaoComportamento'])) {
        $descricaoComportamento = $_POST['descricaoComportamento'];
    } else {
        $descricaoComportamento = NULL;
    }

    if (isset($_POST['danosComportamento'])) {
        $danosComportamento = $_POST['danosComportamento'];
    } else {
        $danosComportamento = NULL;
    }

    if (isset($_POST['situacaoComportamento'])) {
        $situacaoComportamento = $_POST['situacaoComportamento'];
    } else {
        $situacaoComportamento = NULL;
    }

    if (isset($_POST['causasComportamento'])) {
        $causasComportamento = $_POST['causasComportamento'];
    } else {
        $causasComportamento = NULL;
    }

    if (isset($_POST['pessoasDecisaoComportamento'])) {
        $pessoasDecisaoComportamento = $_POST['pessoasDecisaoComportamento'];
    } else {
        $pessoasDecisaoComportamento = NULL;
    }

    if (isset($_POST['sancaoComportamento'])) {
        $sancaoComportamento = $_POST['sancaoComportamento'];
    } else {
        $sancaoComportamento = NULL;
    }

    if (isset($_POST['comentariosComportamento'])) {
        $comentariosComportamento = $_POST['comentariosComportamento'];
    } else {
        $comentariosComportamento = NULL;
    }

    if (isset($_POST['oportunidadeComportamento'])) {
        $oportunidadeComportamento = $_POST['oportunidadeComportamento'];
    } else {
        $oportunidadeComportamento = NULL;
    }

    if (isset($_POST['documentosComportamento'])) {
        $documentosComportamento = $_POST['documentosComportamento'];
    } else {
        $documentosComportamento = NULL;
    }

    $query = "UPDATE comportamentos SET ref_id_colaborador = ?, data_comportamento = ?, descricao = ?, danos = ?, situacao = ?,
analise = ?, pessoas = ?, sancao = ?, comentarios = ?, melhoria = ?, documentos = ? WHERE id_comportamentos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'issssssssssi', $colaboradorComportamento, $novaDataComportamento,
        $descricaoComportamento, $danosComportamento, $situacaoComportamento, $causasComportamento,
        $pessoasDecisaoComportamento, $sancaoComportamento, $comentariosComportamento,
        $oportunidadeComportamento, $documentosComportamento, $comportamento);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarComportamento.php?sucesso=$colaboradorComportamento&comportamento=$comportamento");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarJustificacao.php?erro=$colaboradorComportamento&comportamento=$comportamento");
    }
}