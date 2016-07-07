<?php

session_start();

require("../connection/mysql.php");

if (isset($_POST['atual_password'])) {

        $email = $_SESSION['emailUtilizador'];
        $ativo = 1;

        // Consulta de dados do Utilizador
        $result = $conn->prepare("SELECT hash, password, ativo, validado FROM utilizadores WHERE email = ? AND ativo = ?");
        $result->bind_param('si', $email, $ativo);
        $result->execute();
        $result->bind_result($hashDB, $passwordDB, $utilizadorAtivo, $utilizadorValidado);
        $result->fetch();
        $result->close();

        if ((int)$utilizadorValidado == 1) {
            if ((int)$utilizadorAtivo == 1) {
                if (password_verify($_POST['atual_password'] . $hashDB, $passwordDB)) {

                    $arr = array('valid' => true);
                    echo json_encode($arr);
                    return true;

                } else {
                    $arr = array('valid' => false);
                    echo json_encode($arr);
                    return true;
                }
            } else {
                $arr = array('valid' => false);
                echo json_encode($arr);
                return true;
            }
        } else {
            $arr = array('valid' => false);
            echo json_encode($arr);
            return true;
        }

} else {
    $arr = array('valid' => false);
    echo json_encode($arr);
    return true;
}

?>