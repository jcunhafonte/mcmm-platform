<?php

require_once('connection/dbconnection.php');

// json response array
$response = array("error" => FALSE);

if (isset($_POST['idUT']) && isset($_POST['numeroTransmissao'])) {

    $nrTransmissao = (int)$_POST['numeroTransmissao'];
    $nrUT = (int)$_POST['idUT'];

//    $query = "SELECT id_transmissao FROM transmissoes WHERE ref_id_utilizador = ? ORDER BY id_transmissao DESC LIMIT 1";
//    $stmt = mysqli_prepare($link, $query);
//    mysqli_stmt_bind_param($stmt, 'i', $nrUT);
//    mysqli_stmt_bind_result($stmt, $nrTransmissao);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);

    $query = "UPDATE transmissoes SET direto = 0 WHERE ref_id_utilizador = ?";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $nrUT);

    if (mysqli_stmt_execute($stmt)) {
        $response["error"] = TRUE;
    } else {
        $response["error"] = FALSE;
    }

    mysqli_stmt_close($stmt);
    echo json_encode($response);

}