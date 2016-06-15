<?php

require("../connection/mysql.php");

if (isset($_GET['utilizadorValidado'])) {

    $validarHash = $_GET['utilizadorValidado'];

    $result = $conn->prepare("UPDATE utilizadores SET validado = 1 WHERE hash_email = ?");
    $result->bind_param('s', $validarHash);
    if ($result->execute()) {

        $result->fetch();
        $result->close();

        $result = $conn->prepare("SELECT nome_utilizador, email, id_user FROM utilizadores WHERE hash_email = ?");
        $result->bind_param('s', $validarHash);
        $result->execute();
        $result->bind_result($nomeUser, $emailUser, $idUser);
        $result->fetch();
        $result->close();

        $linkUser ="http://mcmm.tech/@$idUser";

        include_once("../emails/SendGrid/funcoes.php");
        confirmacaoValidacao($nomeUser, $emailUser, $linkUser);

        header("location:../../@$idUser");
    } else {
        header('location:../../');
    }


}