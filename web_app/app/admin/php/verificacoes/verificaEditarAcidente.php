<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['acidente'])) ) {

    $acidente = $_GET['acidente'];

    if (isset($_POST['adicionarColaboradorAcidente'])) {
        $colaboradorAcidente = $_POST['adicionarColaboradorAcidente'];
    } else {
        $colaboradorAcidente = NULL;
    }

    if (isset($_POST['dataAcidente'])) {
        $dataAcidente = $_POST['dataAcidente'];
        $dataAcidente = strtotime($dataAcidente);
        $novaDataAcidente = date('Y-m-d H:i:s', $dataAcidente);
    } else {
        $novaDataAcidente = NULL;
    }

    if (isset($_POST['departamentoAcidente'])) {
        $departamentoAcidente = $_POST['departamentoAcidente'];
    } else {
        $departamentoAcidente = NULL;
    }

    if (isset($_POST['numeroProcessoAcidente'])) {
        $numeroProcessoAcidente = $_POST['numeroProcessoAcidente'];
    } else {
        $numeroProcessoAcidente = NULL;
    }

    if (isset($_POST['atividadeRealizarAcidente'])) {
        $atividadeRealizarAcidente = $_POST['atividadeRealizarAcidente'];
    } else {
        $atividadeRealizarAcidente = NULL;
    }

    if (isset($_POST['descricaoAcidente'])) {
        $descricaoAcidente = $_POST['descricaoAcidente'];
    } else {
        $descricaoAcidente = NULL;
    }

    if (isset($_POST['lesoesAcidente'])) {
        $lesoesAcidente = $_POST['lesoesAcidente'];
    } else {
        $lesoesAcidente = NULL;
    }

    if (isset($_POST['causasAcidente'])) {
        $causasAcidente = $_POST['causasAcidente'];
    } else {
        $causasAcidente = NULL;
    }

    if (isset($_POST['categoriaAcidente'])) {
        $categoriaAcidente = $_POST['categoriaAcidente'];
    } else {
        $categoriaAcidente = NULL;
    }

    if (isset($_POST['tipologiaAcidente'])) {
        $tipologiaAcidente = $_POST['tipologiaAcidente'];
    } else {
        $tipologiaAcidente = NULL;
    }

    if (isset($_POST['tratamentoAcidente'])) {
        $tratamentoAcidente = $_POST['tratamentoAcidente'];
    } else {
        $tratamentoAcidente = NULL;
    }

/////

    if (isset($_POST['horasAusenciaAcidente'])) {
        $horasAusenciaAcidente = $_POST['horasAusenciaAcidente'];
    } else {
        $horasAusenciaAcidente = NULL;
    }

    if (isset($_POST['diasAusenciaAcidente'])) {
        $diasAusenciaAcidente = $_POST['diasAusenciaAcidente'];
    } else {
        $diasAusenciaAcidente = NULL;
    }

    if (isset($_POST['acaoAcidente'])) {
        $acaoAcidente = $_POST['acaoAcidente'];
    } else {
        $acaoAcidente = NULL;
    }

    if (isset($_POST['numeroAcao'])) {
        $numeroAcao = $_POST['numeroAcao'];
    } else {
        $numeroAcao = NULL;
    }

    if (isset($_POST['tipoAcaoAcidente'])) {
        $tipoAcaoAcidente = $_POST['tipoAcaoAcidente'];
    } else {
        $tipoAcaoAcidente = NULL;
    }

    if (isset($_POST['descricaoAcaoAcidente'])) {
        $descricaoAcaoAcidente = $_POST['descricaoAcaoAcidente'];
    } else {
        $descricaoAcaoAcidente = NULL;
    }

    ////

    if (isset($_POST['dataImplementacaoAcidente'])) {
        $dataImplementacaoAcidente = $_POST['dataImplementacaoAcidente'];
        $dataImplementacaoAcidente = strtotime($dataImplementacaoAcidente);
        $novaDataImplementacaoAcidente = date('Y-m-d H:i:s', $dataImplementacaoAcidente);
    } else {
        $novaDataImplementacaoAcidente = NULL;
    }

    if (isset($_POST['resultadosEsperadosAcidente'])) {
        $resultadosEsperadosAcidente = $_POST['resultadosEsperadosAcidente'];
    } else {
        $resultadosEsperadosAcidente = NULL;
    }

    $textoControloExecucaoAcidente='';

    if (isset($_POST['controloExecucaoAcidente1'])) {
        $textoControloExecucaoAcidente = $textoControloExecucaoAcidente . $_POST['controloExecucaoAcidente1'];
    }

    if (isset($_POST['controloExecucaoAcidente2'])) {
        $textoControloExecucaoAcidente = $textoControloExecucaoAcidente . $_POST['controloExecucaoAcidente2'];
    }

    if (isset($_POST['controloExecucaoAcidente3'])) {
        $textoControloExecucaoAcidente = $textoControloExecucaoAcidente . $_POST['controloExecucaoAcidente3'];
    }

    if (isset($_POST['controloExecucaoAcidente4'])) {
        $textoControloExecucaoAcidente = $textoControloExecucaoAcidente . $_POST['controloExecucaoAcidente4'];
    }

    //////

    if (isset($_POST['dataConclusaoAcidente'])) {
        $dataConclusaoAcidente = $_POST['dataConclusaoAcidente'];
        $dataConclusaoAcidente = strtotime($dataConclusaoAcidente);
        $novaDataConclusaoAcidente = date('Y-m-d H:i:s', $dataConclusaoAcidente);
    } else {
        $novaDataConclusaoAcidente = NULL;
    }

    if (isset($_POST['observacoesAcidente'])) {
        $observacoesAcidente = $_POST['observacoesAcidente'];
    } else {
        $observacoesAcidente = NULL;
    }

    if (isset($_POST['eficaciaAcidente'])) {
        $eficaciaAcidente = $_POST['eficaciaAcidente'];
    } else {
        $eficaciaAcidente = NULL;
    }

    if (isset($_POST['responsavelAcidente'])) {
        $responsavelAcidente = $_POST['responsavelAcidente'];
    } else {
        $responsavelAcidente = NULL;
    }

    if (isset($_POST['dataFechoAcidente'])) {
        $dataFechoAcidente = $_POST['dataFechoAcidente'];
        $dataFechoAcidente = strtotime($dataFechoAcidente);
        $novaDataFechoAcidente = date('Y-m-d H:i:s', $dataFechoAcidente);
    } else {
        $novaDataFechoAcidente = NULL;
    }

    $query = "UPDATE acidentes SET ref_id_colaborador = ?, data_acidente = ?, departamento = ?, numero_processo = ?,

atividade = ?, descricao = ?, lesoes = ?, causas = ?, categoria = ?, tipologia = ?, tratamento = ?, ausencia_horas = ?,

 ausencia_dias = ?, acao = ?, numero_acao = ?, tipo_acao = ?, descricao_acao = ?, data_implementacao = ?, resultados = ?,

  controlo = ?, data_conclusao = ?, observacoes = ?, eficacia = ?, responsavel = ?, data_fecho = ?

   WHERE id_acidente = ?";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'issssssssssssssssssssssssi', $colaboradorAcidente, $novaDataAcidente,
        $departamentoAcidente, $numeroProcessoAcidente, $atividadeRealizarAcidente, $descricaoAcidente, $lesoesAcidente,
        $causasAcidente, $categoriaAcidente, $tipologiaAcidente, $tratamentoAcidente, $horasAusenciaAcidente,
        $diasAusenciaAcidente, $acaoAcidente, $numeroAcao, $tipoAcaoAcidente, $descricaoAcaoAcidente,
        $novaDataImplementacaoAcidente, $resultadosEsperadosAcidente, $textoControloExecucaoAcidente,
        $novaDataConclusaoAcidente, $observacoesAcidente, $eficaciaAcidente, $responsavelAcidente,
        $novaDataFechoAcidente, $acidente);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarAcidente.php?sucesso=$colaboradorAcidente&acidente=$acidente");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarAcidente.php?erro=$colaboradorAcidente&acidente=$acidente");
    }
}