<?php

//session_start();
//session_destroy();

require("connection/dbconnection.php");

// json response array
$response = array("error" => FALSE);

//session_start();

if (isset($_POST['email'])) {

    // Consulta de dados do Utilizador
    $query = "SELECT id_utilizador FROM utilizadores WHERE email = ?";

    $email = $_POST['email'];

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_bind_result($stmt, $idUt);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Consulta de dados do Utilizador
        $query = "SELECT nr_video FROM transmissoes WHERE ref_id_utilizador = ? ORDER BY id_transmissao DESC LIMIT 1";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'i', $idUt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);

            $query = "SELECT nr_video FROM transmissoes WHERE ref_id_utilizador = ? ORDER BY id_transmissao DESC LIMIT 1";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 'i', $idUt);
            mysqli_stmt_bind_result($stmt, $idTransmissaoStreamQuerie);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            $idTransmissao = ((int)$idTransmissaoStreamQuerie + 1);

            $user = json_encode(
                [
                    "error" => false,
                    "user" => [
                        "idUtilizador" => $idUt,
                        "idTransmissaoStream" => $idTransmissao
                    ]
                ]
            );
        } else {

            $idTransmissao = 1;

            $user = json_encode(
                [
                    "error" => false,
                    "user" => [
                        "idUtilizador" => (string)$idUt,
                        "idTransmissaoStream" => (string)$idTransmissao
                    ]
                ]
            );
        }

        echo $user;

    } else {
        mysqli_stmt_close($stmt);
        $response["error"] = TRUE;
        $response["error_msg"] = "Ocorreu um problema ao processar o pedido!";
        echo json_encode($response);
    }
}