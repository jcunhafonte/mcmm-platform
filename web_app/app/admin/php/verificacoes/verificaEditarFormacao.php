<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['formacao'])) ) {

    $formacao = $_GET['formacao'];

    if (isset($_POST['adicionarNomeFormacaoColaborador'])) {
        $nomeFormacao = $_POST['adicionarNomeFormacaoColaborador'];
    } else {
        $nomeFormacao = NULL;
    }

    if (isset($_POST['adicionarAnoFormacaoColaborador'])) {
        $anoFormacao = $_POST['adicionarAnoFormacaoColaborador'];
    } else {
        $anoFormacao = NULL;
    }

    if (isset($_POST['adicionarEntidadeFormacaoColaborador'])) {
        $entidadeFormacao = $_POST['adicionarEntidadeFormacaoColaborador'];
    } else {
        $entidadeFormacao = NULL;
    }

    if (isset($_POST['adicionarDuracaoFormacaoColaborador'])) {
        $duracaoFormacao = $_POST['adicionarDuracaoFormacaoColaborador'];
    } else {
        $duracaoFormacao = NULL;
    }

    if (isset($_POST['adicionarDescricaoFormacaoColaborador'])) {
        $descricaoFormacao = $_POST['adicionarDescricaoFormacaoColaborador'];
    } else {
        $descricaoFormacao = NULL;
    }

    $query = "UPDATE formacoes SET ref_id_colaborador = ?, ano = ?, descricao = ?, duracao = ?, entidade = ? WHERE id_formacoes = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'sssssi', $nomeFormacao, $anoFormacao, $descricaoFormacao, $duracaoFormacao, $entidadeFormacao,
        $formacao);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarFormacao.php?sucesso=$nomeFormacao&formacao=$formacao");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarFormacao.php?erro=$nomeFormacao&formacao=$formacao");
    }
}