<?php

session_start();

require("../connection/dbconnection.php");

if (isset($_GET['choice1']) && isset($_GET['choice2'])) {

    $choice1 = $_GET['choice1'];
    $choice2 = $_GET['choice2'];
    $choice3 = $_GET['choice3'];

    $choice1 = $_GET['choice1'];
    $choice1 = strtotime($choice1);
    $novaChoice1 = date('Y-m-d', $choice1);

    $choice2 = $_GET['choice2'];
    $choice2 = strtotime($choice2);
    $novaChoice2 = date('Y-m-d', $choice2);


    $query = "SELECT posto_trabalho FROM colaborador WHERE id_colaborador = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $choice3);
    mysqli_stmt_bind_result($stmt, $postoTrabalhoConsulta);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

// Atualizar na DB data da última visita
    $query = "SELECT COUNT(id_ferias) FROM ferias INNER JOIN colaborador
ON ferias.ref_id_colaborador = colaborador.id_colaborador
WHERE (( ? >= inicio_ferias AND ? <= fim_ferias) OR ( ? >= inicio_ferias AND ? <= fim_ferias))
AND (colaborador.ativo = 1)
AND (colaborador.posto_trabalho = ?)";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'sssss', $novaChoice1, $novaChoice1,
        $novaChoice2, $novaChoice2, $postoTrabalhoConsulta);

    mysqli_stmt_bind_result($stmt, $numeroColaboradorFerias);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);

    echo "<input id='numeroFeriasColaboradores' type='number' value='$numeroColaboradorFerias'>";

    mysqli_stmt_close($stmt);

}