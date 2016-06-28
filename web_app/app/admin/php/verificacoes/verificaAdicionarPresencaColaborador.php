<?php

require_once('../connection/dbconnection.php');

session_start();

if (isset($_SESSION['ativoAdmin'])) {

    $dataPresente = $_GET['data'];

    $query = "SELECT id_presencas FROM presencas WHERE data_presenca = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $dataPresente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        mysqli_stmt_close($stmt);

        $query = "DELETE FROM presencas WHERE data_presenca = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 's', $dataPresente);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

    }else{
        mysqli_stmt_close($stmt);
    }

    foreach ($_POST['presencaColaborador'] as $idPresente) {

        $query = "INSERT INTO presencas(ref_id_colaborador, data_presenca) VALUES (?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'is', $idPresente, $dataPresente);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }

    header("location:../../marcarPresencas.php?sucesso=$dataPresente");
}