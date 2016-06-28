<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['medicina'])) ) {

    $medicina = $_GET['medicina'];

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

    if (isset($_POST['fichaAptidaoColaborador'])) {
        $fichaAptidaoColaborador = $_POST['fichaAptidaoColaborador'];
    } else {
        $fichaAptidaoColaborador = NULL;
    }

    if (isset($_POST['aptoColaborador'])) {
        $aptoColaborador = $_POST['aptoColaborador'];
    } else {
        $aptoColaborador = NULL;
    }

    $query = "UPDATE medicina SET tipo_consulta = ?, data_consulta = ?, ref_colaborador = ?, aptidao = ?, ficha_aptidao = ?
WHERE id_medicina = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'sssssi', $consultaColaborador, $novaDataConsulta, $nomeConsulta, $aptoColaborador,
        $fichaAptidaoColaborador, $medicina);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarMedicina.php?sucesso=$nomeConsulta&medicina=$medicina");
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        header("location:../../editarMedicina.php?erro=$nomeConsulta&medicina=$medicina");
    }
}