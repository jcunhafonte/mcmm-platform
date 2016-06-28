<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['desvinculacao'])) ) {

    $desvinculacao = $_GET['desvinculacao'];

    if (isset($_POST['adicionarNomeDesvinculacao'])) {
        $adicionarNomeDesvinculacao = $_POST['adicionarNomeDesvinculacao'];
    } else {
        $adicionarNomeDesvinculacao = NULL;
    }

    if (isset($_POST['dataEntrevistaDesvinculacao'])) {
        $dataEntrevistaDesvinculacao = $_POST['dataEntrevistaDesvinculacao'];
        $dataEntrevistaDesvinculacao = strtotime($dataEntrevistaDesvinculacao);
        $novaDataEntrevistaDesvinculacao = date('Y-m-d H:i:s', $dataEntrevistaDesvinculacao);
    } else {
        $novaDataEntrevistaDesvinculacao = NULL;
    }

    if (isset($_POST['dataDesvinculacao'])) {
        $dataDesvinculacao = $_POST['dataDesvinculacao'];
        $dataDesvinculacao = strtotime($dataDesvinculacao);
        $novaDataDesvinculacao = date('Y-m-d H:i:s', $dataDesvinculacao);
    } else {
        $novaDataDesvinculacao = NULL;
    }

    if (isset($_POST['motivoDesvinculacao'])) {
        $motivoDesvinculacao = $_POST['motivoDesvinculacao'];
    } else {
        $motivoDesvinculacao = NULL;
    }

    if (isset($_POST['trabalhariaDesvinculacao'])) {
        $trabalhariaDesvinculacao = $_POST['trabalhariaDesvinculacao'];
    } else {
        $trabalhariaDesvinculacao = NULL;
    }

    if (isset($_POST['melhoriaDesvinculacao'])) {
        $melhoriaDesvinculacao = $_POST['melhoriaDesvinculacao'];
    } else {
        $melhoriaDesvinculacao = NULL;
    }

    if (isset($_POST['relacionamentoInterpessoalDesvinculacao'])) {
        $relacionamentoInterpessoalDesvinculacao = $_POST['relacionamentoInterpessoalDesvinculacao'];
    } else {
        $relacionamentoInterpessoalDesvinculacao = NULL;
    }

    if (isset($_POST['melhoriaDesvinculacao'])) {
        $melhoriaDesvinculacao = $_POST['melhoriaDesvinculacao'];
    } else {
        $melhoriaDesvinculacao = NULL;
    }

    if (isset($_POST['estruturaFisicaDesvinculacao'])) {
        $estruturaFisicaDesvinculacao = $_POST['estruturaFisicaDesvinculacao'];
    } else {
        $estruturaFisicaDesvinculacao = NULL;
    }

    if (isset($_POST['valoresNormasEmpresa'])) {
        $valoresNormasEmpresa = $_POST['valoresNormasEmpresa'];
    } else {
        $valoresNormasEmpresa = NULL;
    }

    if (isset($_POST['planeamentoOrganizacaoObjetivos'])) {
        $planeamentoOrganizacaoObjetivos = $_POST['planeamentoOrganizacaoObjetivos'];
    } else {
        $planeamentoOrganizacaoObjetivos = NULL;
    }

    if (isset($_POST['superiorHierarquico'])) {
        $superiorHierarquico = $_POST['superiorHierarquico'];
    } else {
        $superiorHierarquico = NULL;
    }

    if (isset($_POST['gerenciaDesvinculacao'])) {
        $gerenciaDesvinculacao = $_POST['gerenciaDesvinculacao'];
    } else {
        $gerenciaDesvinculacao = NULL;
    }

    if (isset($_POST['contrapartidasEmpresa'])) {
        $contrapartidasEmpresa = $_POST['contrapartidasEmpresa'];
    } else {
        $contrapartidasEmpresa = NULL;
    }

    if (isset($_POST['funcaoExercida'])) {
        $funcaoExercida = $_POST['funcaoExercida'];
    } else {
        $funcaoExercida = NULL;
    }

    if (isset($_POST['comentariosDesvinculacao'])) {
        $comentariosDesvinculacao = $_POST['comentariosDesvinculacao'];
    } else {
        $comentariosDesvinculacao = NULL;
    }

    if (isset($_POST['parecerDesvinculacao'])) {
        $parecerDesvinculacao = $_POST['parecerDesvinculacao'];
    } else {
        $parecerDesvinculacao = NULL;
    }

    if (isset($_POST['readmitidoDesvinculacao'])) {
        $readmitidoDesvinculacao = $_POST['readmitidoDesvinculacao'];
    } else {
        $readmitidoDesvinculacao = NULL;
    }

    if (isset($_POST['porqueDesvinculacao'])) {
        $porqueDesvinculacao = $_POST['porqueDesvinculacao'];
    } else {
        $porqueDesvinculacao = NULL;
    }

    $query = "UPDATE desvinculacao SET ref_id_colaborador = ?, data_entrevista = ?, data_desvinculacao = ?, motivo = ?,
novamente = ?, melhorar = ?, relacionamento = ?, estrutura = ?, valores = ?, planeamento = ?, superior = ?, gerencia = ?,
contrapartidas = ?, funcao = ?, comentarios = ?, parecer = ?, readmissao = ?, porque = ? WHERE id_desvinculacao = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'isssssssssssssssssi', $adicionarNomeDesvinculacao, $novaDataEntrevistaDesvinculacao,
        $novaDataDesvinculacao, $motivoDesvinculacao, $trabalhariaDesvinculacao, $melhoriaDesvinculacao,
        $relacionamentoInterpessoalDesvinculacao, $estruturaFisicaDesvinculacao, $valoresNormasEmpresa, $planeamentoOrganizacaoObjetivos,
        $superiorHierarquico, $gerenciaDesvinculacao, $contrapartidasEmpresa, $funcaoExercida, $comentariosDesvinculacao,
        $parecerDesvinculacao, $readmitidoDesvinculacao, $porqueDesvinculacao, $desvinculacao);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarDesvinculacao.php?sucesso=$adicionarNomeDesvinculacao&desvinculacao=$desvinculacao");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarDesvinculacao.php?erro=$adicionarNomeDesvinculacao&desvinculacao=$desvinculacao");
    }
}