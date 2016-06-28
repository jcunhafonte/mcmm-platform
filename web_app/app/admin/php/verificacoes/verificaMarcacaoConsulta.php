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

   $query = "INSERT INTO marcacao_consulta(ref_id_colaborador, tipo_consulta,
 data_consulta) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'iss', $nomeConsulta, $consultaColaborador,
        $novaDataConsulta);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header('location:../../marcacaoMedicina.php?sucesso='.$nomeConsulta);
    }else{
        mysqli_stmt_close($stmt);
        header('location:../../marcacaoMedicina.php?erro='.$nomeConsulta);
    }
}