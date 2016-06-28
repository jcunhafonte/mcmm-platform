<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    if (isset($_POST['tituloFuncaoDefinicao'])) {
        $tituloFuncaoDefinicao = $_POST['tituloFuncaoDefinicao'];
    } else {
        $tituloFuncaoDefinicao = NULL;
    }

    if (isset($_POST['objetivoDefinicao'])) {
        $objetivoDefinicao = $_POST['objetivoDefinicao'];
    } else {
        $objetivoDefinicao = NULL;
    }

    if (isset($_POST['enquadramentoDefinicao'])) {
        $enquadramentoDefinicao = $_POST['enquadramentoDefinicao'];
    } else {
        $enquadramentoDefinicao = NULL;
    }

    if (isset($_POST['conteudoDescricao'])) {
        $conteudoDescricao = $_POST['conteudoDescricao'];
    } else {
        $conteudoDescricao = NULL;
    }

    if (isset($_POST['tecnicasDescricao'])) {
        $tecnicasDescricao = $_POST['tecnicasDescricao'];
    } else {
        $tecnicasDescricao = NULL;
    }

    if (isset($_POST['comportamentaisDescricao'])) {
        $comportamentaisDescricao = $_POST['comportamentaisDescricao'];
    } else {
        $comportamentaisDescricao = NULL;
    }

    if (isset($_POST['requisitosDefinicao'])) {
        $requisitosDefinicao = $_POST['requisitosDefinicao'];
    } else {
        $requisitosDefinicao = NULL;
    }

    if (isset($_POST['substitutoDefinicao'])) {
        $substitutoDefinicao = $_POST['substitutoDefinicao'];
    } else {
        $substitutoDefinicao = NULL;
    }

    if (isset($_POST['fisicasMateriaisDefinicao'])) {
        $fisicasMateriaisDefinicao = $_POST['fisicasMateriaisDefinicao'];
    } else {
        $fisicasMateriaisDefinicao = NULL;
    }

    if (isset($_POST['contrapartidasDefinicao'])) {
        $contrapartidasDefinicao = $_POST['contrapartidasDefinicao'];
    } else {
        $contrapartidasDefinicao = NULL;
    }

   $query = "INSERT INTO descricao(titulo, objetivo, enquadramento, conteudo, competencias_tecnicas,
competencias_comportamentais, requisitos_minimos, substitutos, condicoes, contrapartidas)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssss', $tituloFuncaoDefinicao, $objetivoDefinicao,
        $enquadramentoDefinicao, $conteudoDescricao, $tecnicasDescricao, $comportamentaisDescricao,
        $requisitosDefinicao, $substitutoDefinicao, $fisicasMateriaisDefinicao, $contrapartidasDefinicao);

    if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);
        header('location:../../registarDescricao.php?sucesso='.$tituloFuncaoDefinicao);
    }else{

        mysqli_stmt_close($stmt);
        header('location:../../registarDescricao.php?erro='.$tituloFuncaoDefinicao);
    }
}