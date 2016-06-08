<?php

//session_start();
//session_destroy();

$seed = 'DB97368CFAE81F9852EF15F76B6CF';

require("connection/dbconnection.php");

// json response array
$response = array("error" => FALSE);

//session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) AND strpos($_POST['email'], '@ua.pt') == TRUE) {

        // Consulta de dados do Utilizador
        $query = "SELECT hash, password FROM utilizadores WHERE email = ?";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);

        $email = $_POST['email'];

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hashDB, $passwordDB);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (password_verify($_POST['password'] . $hashDB, $passwordDB)) {

            // Consulta de dados do Utilizador
            $query = "SELECT id_utilizador, nome_utilizador, data_registo, ultima_visita FROM utilizadores WHERE email = ?";

            $email = $_POST['email'];
            $stmt = mysqli_prepare($link, $query);

            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_bind_result($stmt, $id, $name, $created, $update);

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                $user = json_encode(
                    [
                        "error" => false,
                        "uid" => $id,
                        "user" => [
                            "name" => $name,
                            "email" => $email,
                            "created_at" => $created,
                            "updated_at" => $update
                        ]
                    ]
                );
                echo $user;
            }else{
                mysqli_stmt_close($stmt);
                $response["error"] = TRUE;
                $response["error_msg"] = "Ocorreu um problema ao processar o pedido!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Verifica se a tua palavra-passe se encontra correta!";
            echo json_encode($response);
        }
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Verifica se o teu email se encontra correto!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Necessitas de introduzir os dados solicitados!";
    echo json_encode($response);
}