<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    if (isset($_POST['adicionarColaboradorMudanca'])) {
        $colaboradorMudanca = $_POST['adicionarColaboradorMudanca'];
    } else {
        $colaboradorMudanca = NULL;
    }

    if (isset($_POST['dataMudanca'])) {
        $dataMudanca = $_POST['dataMudanca'];
        $dataMudanca = strtotime($dataMudanca);
        $novaDataMudanca = date('Y-m-d H:i:s', $dataMudanca);
    } else {
        $novaDataMudanca = NULL;
    }

    if (isset($_POST['medidaMudanca'])) {
        $medidaMudanca = $_POST['medidaMudanca'];
    } else {
        $medidaMudanca = NULL;
    }

    if (isset($_POST['causaMudanca'])) {
        $causaMudanca = $_POST['causaMudanca'];
    } else {
        $causaMudanca = NULL;
    }

    if (isset($_POST['funcaoMudanca'])) {
        $funcaoMudanca = $_POST['funcaoMudanca'];
    } else {
        $funcaoMudanca = NULL;
    }

    if (isset($_POST['novoVencimentoMudanca'])) {
        $novoVencimentoColaborador = $_POST['novoVencimentoMudanca'];
        $symbols = array('$', '€', '£');
        $novoVencimentoColaborador = str_replace($symbols, '', $novoVencimentoColaborador);
    } else {
        $novoVencimentoColaborador = NULL;
    }

    if (isset($_POST['experienciaMudanca'])) {
        $experienciaMudanca = $_POST['experienciaMudanca'];
    } else {
        $experienciaMudanca = NULL;
    }

    if (isset($_POST['eficaciaMudanca'])) {
        $eficaciaMudanca = $_POST['eficaciaMudanca'];
    } else {
        $eficaciaMudanca = NULL;
    }

    if (isset($_POST['comentarioMudanca'])) {
        $comentarioMudanca = $_POST['comentarioMudanca'];
    } else {
        $comentarioMudanca = NULL;
    }

    $query = "SELECT funcao, vencimento_base FROM colaborador WHERE id_colaborador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $colaboradorMudanca);
    mysqli_stmt_bind_result($stmt, $historicoFuncao, $historicoVencimento);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

   $query = "INSERT INTO mudancas(ref_id_colaborador, data_mudanca, medida, causa, funcao, vencimento,
periodo_experiencia, eficacia, comentarios, historico_funcao, historico_vencimento)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'issssssssss', $colaboradorMudanca, $novaDataMudanca, $medidaMudanca,
        $causaMudanca, $funcaoMudanca, $novoVencimentoColaborador, $experienciaMudanca, $eficaciaMudanca,
        $comentarioMudanca, $historicoFuncao, $historicoVencimento);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);

        $query = "UPDATE colaborador SET vencimento_base = ?, funcao = ? WHERE id_colaborador = ?";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $novoVencimentoColaborador, $funcaoMudanca, $colaboradorMudanca);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $query = "UPDATE contrato SET vencimento_base = ?, funcao = ? WHERE ref_id_colaborador = ? AND atual = 1";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $novoVencimentoColaborador, $funcaoMudanca, $colaboradorMudanca);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('location:../../adicionarMudancas.php?sucesso='.$colaboradorMudanca);
    }else{
        mysqli_stmt_close($stmt);
        header('location:../../adicionarMudancas.php?erro='.$colaboradorMudanca);
    }
}