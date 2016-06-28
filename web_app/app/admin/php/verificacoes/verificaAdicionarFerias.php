<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    if (isset($_POST['adicionarNomeFerias'])) {
        $nomeFerias = $_POST['adicionarNomeFerias'];
    } else {
        $nomeFerias = NULL;
    }

    if (isset($_POST['dataInicioFerias'])) {
        $dataInicioFerias = $_POST['dataInicioFerias'];
        $dataInicioFerias = strtotime($dataInicioFerias);
        $novaDataInicioFerias = date('Y-m-d H:i:s', $dataInicioFerias);
    } else {
        $novaDataInicioFerias = NULL;
    }

    if (isset($_POST['dataFimFerias'])) {
        $dataFimFerias = $_POST['dataFimFerias'];
        $dataFimFerias = strtotime($dataFimFerias);
        $novaDataFimFerias = date('Y-m-d H:i:s', $dataFimFerias);
    } else {
        $novaDataFimFerias = NULL;
    }

   $query = "INSERT INTO ferias(ref_id_colaborador, inicio_ferias, fim_ferias) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'iss', $nomeFerias, $novaDataInicioFerias, $novaDataFimFerias);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header('location:../../adicionarFerias.php?sucesso='.$nomeFerias);
    }else{
        mysqli_stmt_close($stmt);
        header('location:../../adicionarFerias.php?erro='.$nomeJustificacao);
    }
}