<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['contrato'])) ) {

    $contrato = $_GET['contrato'];

    // Terceira Parte

    if (isset($_POST['funcaoColaborador'])) {
        $funcaoColaborador = $_POST['funcaoColaborador'];
    } else {
        $funcaoColaborador = NULL;
    }

    if (isset($_POST['categoriaColaborador'])) {
        $categoriaColaborador = $_POST['categoriaColaborador'];
    } else {
        $categoriaColaborador = NULL;
    }

    if (isset($_POST['postoTrabalhoColaborador'])) {
        $postoTrabalhoColaborador = $_POST['postoTrabalhoColaborador'];
    } else {
        $postoTrabalhoColaborador = NULL;
    }

    if (isset($_POST['situacaoContratualColaborador'])) {
        $situacaoContratualColaborador = $_POST['situacaoContratualColaborador'];
    } else {
        $situacaoContratualColaborador = NULL;
    }

    if (isset($_POST['periodoExperimentalColaborador'])) {
        $periodoExperimentalColaborador = $_POST['periodoExperimentalColaborador'];
    } else {
        $periodoExperimentalColaborador = NULL;
    }

    if (isset($_POST['periodoExperimentalColaborador'])) {
        $periodoExperimentalColaborador = $_POST['periodoExperimentalColaborador'];
    } else {
        $periodoExperimentalColaborador = NULL;
    }

    if (isset($_POST['dataFinalPeriodoExperimentalColaborador'])) {

        $dataFinalPeriodoExperimentalColaborador = $_POST['dataFinalPeriodoExperimentalColaborador'];
        $dataFinalPeriodoExperimentalColaborador = strtotime($dataFinalPeriodoExperimentalColaborador);
        $novaDataFinalPeriodoExperimentalColaborador = date('Y-m-d H:i:s', $dataFinalPeriodoExperimentalColaborador);

    } else {
        $novaDataFinalPeriodoExperimentalColaborador = NULL;
    }

    if (isset($_POST['dataAdmissao'])) {

        $dataAdmissao = $_POST['dataAdmissao'];
        $dataAdmissao = strtotime($dataAdmissao);
        $novaDataAdmissao = date('Y-m-d H:i:s', $dataAdmissao);
    } else {
        $novaDataAdmissao = NULL;
    }

    if (isset($_POST['horasSemanaisColaborador'])) {
        $horasSemanaisColaborador = $_POST['horasSemanaisColaborador'];
    } else {
        $horasSemanaisColaborador = NULL;
    }

    if (isset($_POST['horasDiariasColaborador'])) {
        $horasDiariasColaborador = $_POST['horasDiariasColaborador'];
    } else {
        $horasDiariasColaborador = NULL;
    }

    if (isset($_POST['descansoComplementarColaborador'])) {
        $descansoComplementarColaborador = $_POST['descansoComplementarColaborador'];
    } else {
        $descansoComplementarColaborador = NULL;
    }

    if (isset($_POST['sistemaRotativoColaborador'])) {
        $sistemaRotativoColaborador = $_POST['sistemaRotativoColaborador'];
    } else {
        $sistemaRotativoColaborador = NULL;
    }

    if (isset($_POST['NIBColaborador'])) {
        $NIBColaborador = $_POST['NIBColaborador'];
    } else {
        $NIBColaborador = NULL;
    }

    if (isset($_POST['isntBancariaColaborador'])) {
        $isntBancariaColaborador = $_POST['isntBancariaColaborador'];
    } else {
        $isntBancariaColaborador = NULL;
    }

    if (isset($_POST['agenciaColaborador'])) {
        $agenciaColaborador = $_POST['agenciaColaborador'];
    } else {
        $agenciaColaborador = NULL;
    }

    if (isset($_POST['vencBaseColaborador'])) {
        $vencBaseColaborador = $_POST['vencBaseColaborador'];
        $symbols = array('$', '€', '£');
        $vencBaseColaborador = str_replace($symbols, '', $vencBaseColaborador);
    } else {
        $vencBaseColaborador = NULL;
    }


    if (isset($_POST['dataFinalContratoColaborador'])) {

        $dataFinalContratoColaborador = $_POST['dataFinalContratoColaborador'];
        $dataFinalContratoColaborador = strtotime($dataFinalContratoColaborador);
        $novaDataFinalContratoColaborador = date('Y-m-d H:i:s', $dataFinalContratoColaborador);
    } else {
        $novaDataFinalContratoColaborador = NULL;
    }

    if (isset($_POST['escolaridadeColaborador'])) {
        $escolaridadeColaborador = $_POST['escolaridadeColaborador'];
    } else {
        $escolaridadeColaborador = NULL;
    }

    $idColaboradorContrato = $_POST['idColaborador'];

    $query = "UPDATE contrato SET situacao_contratual = ?, posto_trabalho = ?, periodo_experimental = ?,
data_final_per_experimental = ?, funcao = ?, categoria = ?, horas_semanais = ?, horas_diarias = ?, descanso_complementar = ?,
sistema_rotativo = ?, NIB = ?, instituicao_bancaria = ?, agencia = ?, vencimento_base = ?, data_admissao = ?,
data_final_contrato = ?, data_contrato = ? WHERE ref_id_colaborador = ?";

    $dataAtual = date('Y-m-d H:i:s');
    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'ssisssiississssssi', $situacaoContratualColaborador, $postoTrabalhoColaborador,
        $periodoExperimentalColaborador, $novaDataFinalPeriodoExperimentalColaborador, $funcaoColaborador,
        $categoriaColaborador, $horasSemanaisColaborador, $horasDiariasColaborador, $descansoComplementarColaborador,
        $sistemaRotativoColaborador, $NIBColaborador, $isntBancariaColaborador, $agenciaColaborador,
        $vencBaseColaborador, $novaDataAdmissao, $novaDataFinalContratoColaborador, $dataAtual, $idColaboradorContrato);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if(isset($_GET['atual'])){

            $query = "UPDATE colaborador SET situacao_contratual = ?, posto_trabalho = ?, periodo_experimental = ?,
data_final_per_experimental = ?, funcao = ?, categoria = ?, horas_semanais = ?, horas_diarias = ?,
descanso_complementar = ?, sistema_rotativo = ?, NIB = ?, instituicao_bancaria = ?, agencia = ?,
vencimento_base = ?, data_admissao = ?, data_final_contrato = ? WHERE id_colaborador = ?";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 'ssisssiississsssi', $situacaoContratualColaborador, $postoTrabalhoColaborador,
                $periodoExperimentalColaborador, $novaDataFinalPeriodoExperimentalColaborador, $funcaoColaborador,
                $categoriaColaborador, $horasSemanaisColaborador, $horasDiariasColaborador, $descansoComplementarColaborador,
                $sistemaRotativoColaborador, $NIBColaborador, $isntBancariaColaborador, $agenciaColaborador,
                $vencBaseColaborador, $novaDataAdmissao, $novaDataFinalContratoColaborador, $idColaboradorContrato);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

        }

        header("location:../../editarContrato.php?sucesso=$idColaboradorContrato&contrato=$contrato");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarContrato.php?erro=$idColaboradorContrato&contrato=$contrato");
    }
}