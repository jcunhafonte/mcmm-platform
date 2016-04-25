<?php

require_once('connection/dbconnection.php');

// json response array
$response = array("error" => FALSE);

if (isset($_POST['ref_id_utilizador']) && isset($_POST['nome']) && isset($_POST['tema'])
    && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['numeroVideo'])
) {

    $refIDUtilizador = (int)$_POST['ref_id_utilizador'];
    $nome = $_POST['nome'];
    $tema = $_POST['tema'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $dataTransmissao = date('Y-m-d H:i:s');
    $numeroRefIDUtilizador = (int)$refIDUtilizador;
    $nrVideo = (int)$_POST['numeroVideo'];
    $direto = 1;

    $stringLatitude = (float)$latitude;
    $stringLongitude = (float)$longitude;

    $query = "INSERT INTO transmissoes(ref_id_utilizador, nome, data_transmissao, tema, latitude, longitude,
nr_video, direto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'isssddii', $numeroRefIDUtilizador, $nome, $dataTransmissao, $tema,
        $stringLatitude, $stringLongitude, $nrVideo, $direto);

    if (mysqli_stmt_execute($stmt)) {
        $response["error"] = TRUE;
    } else {
        $response["error"] = FALSE;
    }

    mysqli_stmt_close($stmt);

    echo json_encode($response);

    var_dump(mysqli_error($link));

}