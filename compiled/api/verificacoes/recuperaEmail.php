<?php

require("../connection/mysql.php");

if (isset($_POST['email'])) {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $email = $_POST['email'];
        $ativo = 1;

        $result = $conn->prepare("SELECT hash_email, nome_utilizador FROM utilizadores WHERE email = ? AND validado = 1");
        $result->bind_param('s', $email);
        $result->execute();
        $result->bind_result($hashEmail, $nomeUt);
        $result->fetch();
        $result->close();

        $linkUser = "http://mcmm.tech/?recover=$hashEmail";
        include_once("../emails/SendGrid/funcoes.php");
        recoverPassword($nomeUt, $email, $linkUser);

        echo "yes";

    }else{
        echo "no";
    }
}else{
    echo "no";
}

?>