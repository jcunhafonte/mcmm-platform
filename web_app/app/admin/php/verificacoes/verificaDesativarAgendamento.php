<?php

require_once('../connection/dbconnection.php');

session_start();

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['agendamento'])) AND (!isset($_GET['perfil']))) {

    $agendamento = $_GET['agendamento'];
    
    $query = "DELETE FROM agendamentos WHERE id_agendamentos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $agendamento);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../agendamentos.php?agendamentoRemovido=" . $agendamento);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../agendamentos.php?agendamentoRemovidoErro=" . $agendamento);

    }

}

if ((isset($_SESSION['ativoAdmin'])) AND (isset($_GET['agendamento'])) AND (isset($_GET['perfil']))) {

    $agendamento = $_GET['agendamento'];

    $query = "DELETE FROM agendamentos WHERE id_agendamentos = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $agendamento);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        header("location:../../agendamentos.php?agendamentoRemovido=" . $agendamento);

    } else {

        mysqli_stmt_close($stmt);
        header("location:../../agendamentos.php?agendamentoRemovidoErro=" . $agendamento);

    }

}