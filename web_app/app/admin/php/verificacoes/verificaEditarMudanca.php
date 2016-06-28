<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['mudanca'])) ) {

    $mudanca = $_GET['mudanca'];

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

    $query = "UPDATE mudancas SET ref_id_colaborador = ?, data_mudanca = ?, medida = ?, causa = ?, funcao = ?, vencimento = ?,
periodo_experiencia = ?, eficacia = ?, comentarios = ? WHERE id_mudanca = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'issssssssi', $colaboradorMudanca, $novaDataMudanca, $medidaMudanca,
        $causaMudanca, $funcaoMudanca, $novoVencimentoColaborador, $experienciaMudanca, $eficaciaMudanca,
        $comentarioMudanca, $mudanca);

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

        header("location:../../editarMudanca.php?sucesso=$colaboradorMudanca&mudanca=$mudanca");
    }else{
        mysqli_stmt_close($stmt);
        header("location:../../adicionarMudancas.php?erro=$colaboradorMudanca&mudanca=$mudanca");
    }
}