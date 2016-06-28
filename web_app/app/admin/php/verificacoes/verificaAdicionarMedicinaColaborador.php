<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

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

   $query = "INSERT INTO medicina(ref_colaborador, tipo_consulta,
 data_consulta, ficha_aptidao, aptidao) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'issss', $nomeConsulta, $consultaColaborador,
        $novaDataConsulta, $fichaAptidaoColaborador, $aptoColaborador);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header('location:../../adicionarMedicinaColaboradores.php?sucesso='.$nomeConsulta);
    }else{
        mysqli_stmt_close($stmt);
        header('location:../../adicionarMedicinaColaboradores.php?erro='.$nomeConsulta);
    }
}