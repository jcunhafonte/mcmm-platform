<?php

session_start();

require("../connection/mysql.php");

if (isset($_POST['password']) AND isset($_POST['confirm_password']) AND isset($_POST['hash_email'])) {

    if ($_POST['password'] == $_POST['confirm_password']) {

        $result = $conn->prepare("SELECT nome_utilizador, id_user, email, hash, password FROM utilizadores WHERE hash_email = ?");
        $result->bind_param('s', $_POST['hash_email']);
        $result->execute();
        $result->bind_result($nomeUt, $userID, $emailUt, $hashDB, $passwordDB);
        $result->fetch();
        $result->close();


        $seed = 'DB97368CFAE81F9852EF15F76B6CF';
        $hash = hash("sha512", $seed . mt_rand());
        $password = password_hash($_POST['password'] . $hash, PASSWORD_BCRYPT);

        $result = $conn->prepare("UPDATE utilizadores SET hash = ?, password = ? WHERE hash_email = ?");

        $result->bind_param('ssi', $hash, $password, $_POST['hash_email']);
        $result->execute();
        $result->fetch();
        $result->close();

        include_once("../emails/SendGrid/funcoes.php");
        $linkUser = "http://mcmm.tech/@" . $userID;
        alteracaoPassword($nomeUt, $emailUt, $linkUser);

        unset($_SESSION['account_recover']);

        echo "yes";


    } else {
        echo "no";
    }
}

?>