<?php

header('Access-Control-Allow-Origin: *');

require("../connection/mysql.php");

if (isset($_POST['emailUtilizador'])) {

    if (filter_var($_POST['emailUtilizador'], FILTER_VALIDATE_EMAIL)) {

        $email = $_POST['emailUtilizador'];
        $ativo = 1;

        $result = $conn->prepare("SELECT email FROM utilizadores WHERE email = ?");
        $result->bind_param('s', $email);
        $result->execute();
        $result->store_result();
        $row_number = $result->num_rows;

        if ($row_number == 0) {
            $result->close();
            echo "registo=1";
            return true;
        } else {
            $result->close();
            echo "registo=0";
            return true;
        }
      
    } else {
        echo "entrar=2";
    }
} else {
    echo "registo=3";
}

?>