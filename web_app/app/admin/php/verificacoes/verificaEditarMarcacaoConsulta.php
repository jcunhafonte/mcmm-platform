<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin']) AND isset($_GET['marcacao'])) {

    $marcacao = $_GET['marcacao'];

    if (isset($_POST['adicionarNomeMedicinaColaborador'])) {
        $nomeConsulta = $_POST['adicionarNomeMedicinaColaborador'];
    } else {
        $nomeConsulta = NULL;
    }

    if (isset($_POST['tipoConsultaColaborador'])) {
        $consultaColaborador = $_POST['tipoConsultaColaborador'];
    } else {
        $consultaColaborador = NULL;
    }

    if (isset($_POST['dataConsultaColaborador'])) {
        $dataConsulta = $_POST['dataConsultaColaborador'];
        $dataConsulta = strtotime($dataConsulta);
        $novaDataConsulta = date('Y-m-d H:i:s', $dataConsulta);
    } else {
        $novaDataConsulta = NULL;
    }

    $query = "UPDATE marcacao_consulta SET ref_id_colaborador = ?, tipo_consulta = ?, data_consulta = ? WHERE id_marcacao = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'issi', $nomeConsulta, $consultaColaborador,
        $novaDataConsulta, $marcacao);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header('location:../../editarMarcacao.php?sucesso=' . $nomeConsulta . "&marcacao=$marcacao");
    } else {
        mysqli_stmt_close($stmt);
        header('location:../../editarMarcacao.php?erro=' . $nomeConsulta. "&marcacao=$marcacao");
    }
}