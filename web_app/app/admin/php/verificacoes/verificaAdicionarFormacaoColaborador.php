<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

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

   $query = "INSERT INTO formacoes(ref_id_colaborador, ano, descricao,
duracao, entidade) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'iisis', $nomeFormacao, $anoFormacao,
        $descricaoFormacao, $duracaoFormacao, $entidadeFormacao);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
     header('location:../../adicionarFormacaoColaboradores.php?sucesso='.$nomeFormacao);
    }else{
        mysqli_stmt_close($stmt);
        header('location:../../adicionarFormacaoColaboradores.php?erro='.$nomeFormacao);
    }
}